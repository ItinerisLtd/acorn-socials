<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Managers;

use Closure;

class SharableSocials
{
    private bool $setUrls = false;

    private array $socials = [
        [
            'name' => 'Email',
            'key' => 'email',
            'url' => 'mailto:?subject={{ url }}&body={{ short_content }}',
            'place_holders' => [
                'url',
                'short_content',
            ],
            'only_sharable' => true, // Indicates that can be used only on sharable content.
        ],
        [
            'name' => 'Facebook',
            'key' => 'facebook',
            'url' => 'https://www.facebook.com/sharer.php?u={{ url }}',
            'place_holders' => [
                'url',
            ],
        ],
        [
            'name' => 'X',
            'key' => 'twitter,x-twitter',
            'url' => 'https://twitter.com/intent/tweet?text={{ short_content }}&url={{ url }}',
            'place_holders' => [
                'url',
                'short_content',
            ],
        ],
        [
            'name' => 'WhatsApp',
            'key' => 'whatsapp',
            'url' => 'https:// wa.me/?text={{ url }}',
            'place_holders' => [
                'url',
            ],
            'only_sharable' => true,
        ],
        [
            'name' => 'Bluesky',
            'key' => 'bluesky',
            'url' => 'https://bsky.app/intent/compose?text={{ url }}',
            'place_holders' => [
                'url',
            ],
        ],
        [
            'name' => 'LinkedIn',
            'key' => 'linkedin',
            'url' => 'https://www.linkedin.com/sharing/share-offsite/?url={{ url }}',
            'place_holders' => [
                'url',
            ],
        ],
        [
            'name' => 'Reddit',
            'key' => 'reddit',
            'url' => 'https://www.reddit.com/submit?url={{ url }}&title={{ title }}',
            'place_holders' => [
                'url',
                'title',
            ],
            'only_sharable' => true,
        ],
        [
            'name' => 'Tumblr',
            'key' => 'tumblr',
            'url' => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl={{ url }}&title={{ title }}',
            'place_holders' => [
                'url',
                'title',
            ],
            'only_sharable' => true,
        ],
        [
            'name' => 'Pocket',
            'key' => 'pocket',
            'url' => 'https://getpocket.com/save?url={{ url }}&title={{ title }}',
            'place_holders' => [
                'url',
                'title',
            ],
            'only_sharable' => true,
        ],
        [
            'name' => 'Pinterest',
            'key' => 'pinterest',
            'url' => 'https://pinterest.com/pin/create/button/?url={{ url }}',
            'place_holders' => [
                'url',
            ],
            'only_sharable' => true,
        ],
    ];

    public function __construct()
    {
        $this->aliasSets();
    }

    public function getSharableSocials(): array
    {
        if (is_singular() && ! $this->setUrls) {
            $this->setShareUrls();
            $this->setUrls = true;
        }
        return $this->socials;
    }

    private function aliasSets(): void
    {
        foreach ($this->socials as $i => $social) {
            $url = $social['url'] ?? '';
            $key = $social['key'] ?? '';
            if (empty($url) || empty($key)) {
                unset($this->socials[$i]);
                continue;
            }

            // Alias distributions.
            if (str_contains($key, ',')) {
                $aliases = explode(',', $key);
                foreach ($aliases as $alias) {
                    $this->socials[] = array_merge(
                        $social,
                        [
                            'key' => trim($alias),
                        ],
                    );
                }
                unset($this->socials[$i]);
            }
        }
    }

    private function setShareUrls(): void
    {
        foreach ($this->socials as &$social) {
            $url = $social['url'];
            $placeHolders = $social['place_holders'] ?? [];
            foreach ($placeHolders as $placeHolder) {
                $url = preg_replace(
                    '/{{\s*' . $placeHolder . '\s*}}/',
                    rawurlencode($this->placeHoldersFuncs($placeHolder)()),
                    $url,
                );
            }
            $social['url'] = $url;
        }
    }

    private function placeHoldersFuncs(string $expression): Closure
    {
        return match ($expression) {
            'url' => fn(): string => (string) get_permalink(),
            'title' =>  fn(): string => (string) get_the_title(),
            'short_content' => fn(): string => function_exists('get_field')
                ? ((string) get_field('summary', get_the_ID())) : '__return_empty_string',
            default => '__return_empty_string',
        };
    }
}
