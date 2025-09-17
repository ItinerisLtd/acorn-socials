<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Managers;

class SocialsManager
{
    private array $allowedSocialItemKeys = [
        'name',
        'key',
        'icon',
        'url',
        'html',
        'accessibility',
        'meta',
    ];

    private array $definedSocials = [
        'email' => [
            'name' => 'Email',
            'key' => 'email',
            'sharer_url' => 'mailto:?subject={{ url }}&body={{ summary }}',
            'placeholders' => ['url', 'summary'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page via email',
            ],
            'meta' => [],
        ],
        'facebook' => [
            'name' => 'Facebook',
            'key' => 'facebook',
            'sharer_url' => 'https://www.facebook.com/sharer.php?u={{ url }}',
            'placeholders' => ['url'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page on facebook',
            ],
            'meta' => [],
        ],
        'twitter' => [
            'name' => 'X',
            'key' => 'twitter',
            'sharer_url' => 'https://twitter.com/intent/tweet?text={{ summary }}&url={{ url }}',
            'placeholders' => ['url', 'summary'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page on x',
            ],
            'meta' => [],
        ],
        'instagram' => [
            'name' => 'Instagram',
            'key' => 'instagram',
            'sharer_url' => '',
            'placeholders' => [],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Go to brand instagram page',
            ],
            'meta' => [],
        ],
        'youtube' => [
            'name' => 'YouTube',
            'key' => 'youtube',
            'sharer_url' => '',
            'placeholders' => [],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Go to brand youtube page',
            ],
            'meta' => [],
        ],
        'whatsapp' => [
            'name' => 'WhatsApp',
            'key' => 'whatsapp',
            'sharer_url' => 'https://wa.me/?text={{ url }}',
            'placeholders' => ['url'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page via whatsapp',
            ],
            'meta' => [],
        ],
        'bluesky' => [
            'name' => 'Bluesky',
            'key' => 'bluesky',
            'sharer_url' => 'https://bsky.app/intent/compose?text={{ url }}',
            'placeholders' => ['url'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page on bluesky',
            ],
            'meta' => [],
        ],
        'linkedin' => [
            'name' => 'LinkedIn',
            'key' => 'linkedin',
            'sharer_url' => 'https://www.linkedin.com/sharing/share-offsite/?url={{ url }}',
            'placeholders' => ['url'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page on linkedin',
            ],
            'meta' => [],
        ],
        'reddit' => [
            'name' => 'Reddit',
            'key' => 'reddit',
            'sharer_url' => 'https://www.reddit.com/submit?url={{ url }}&title={{ title }}',
            'placeholders' => ['url', 'title'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page with reddit',
            ],
            'meta' => [],
        ],
        'tumblr' => [
            'name' => 'Tumblr',
            'key' => 'tumblr',
            'sharer_url' => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl={{ url }}&title={{ title }}',
            'placeholders' => ['url', 'title'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Save this page on thumblr',
            ],
            'meta' => [],
        ],
        'pocket' => [
            'name' => 'Pocket',
            'key' => 'pocket',
            'sharer_url' => 'https://getpocket.com/save?url={{ url }}&title={{ title }}',
            'placeholders' => ['url', 'title'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Save this page on pocket',
            ],
            'meta' => [],
        ],
        'pinterest' => [
            'name' => 'Pinterest',
            'key' => 'pinterest',
            'sharer_url' => 'https://pinterest.com/pin/create/button/?url={{ url }}',
            'placeholders' => ['url'],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page with pinterest',
            ],
            'meta' => [],
        ],
        'native' => [
            'name' => 'Native Share',
            'key' => 'native',
            'sharer_url' => '',
            'placeholders' => [],
            'html' => [
                'attributes' => [],
            ],
            'accessibility' => [
                'sr_text' => 'Share this page',
            ],
            'meta' => [
                'tooltip' => [
                    'text' => 'Share',
                ],
            ],
        ],
        'print' => [
            'name' => 'Print',
            'key' => 'print',
            'sharer_url' => '',
            'placeholders' => [],
            'html' => [
                'attributes' => [
                    'onclick' => 'print()',
                ],
            ],
            'accessibility' => [
                'sr_text' => 'Print this page',
            ],
            'meta' => [],
        ],
        'copy_to_clipboard' => [
            'name' => 'Clipboard To Copy',
            'key' => 'copy_to_clipboard',
            'sharer_url' => '',
            'placeholders' => [],
            'html' => [
                'attributes' => [
                    'data-copy-to-clipboard-target' => 'clipboard-page-link',
                    'data-copy-to-clipboard-content-type' => 'textContent',
                ],
            ],
            'accessibility' => [
                'sr_text' => 'Copy this page link to clipboard',
            ],
            'meta' => [
                'tooltip' => [
                    'text' => 'Copy',
                ],
            ],
        ],
    ];

    public function getDefinedSocials(): array
    {
        return $this->definedSocials;
    }

    public function getSocialPages(array $registeredSocials): array
    {
        $socialPages = $this->getFilteredSocials($registeredSocials);
        $socialPageAllowList = ConfigManager::getSocialPageAllowList();

        if (!empty($socialPageAllowList)) {
            $socialPages = array_intersect_key(
                $socialPages,
                array_flip(ConfigManager::getSocialPageAllowList()),
            );
        }

        return array_map(
            function (array $social): object {
                $social = $this->setSocialPageUrl($social);
                $social = $this->setIconFullName($social);
                return (object) array_intersect_key($social, array_flip($this->allowedSocialItemKeys));
            },
            $socialPages,
        );
    }

    public function getSharableSocials(array $registeredSocials): array
    {
        $sharableSocials =  $this->getFilteredSocials($registeredSocials);
        $sharableAllowList = ConfigManager::getSharableAllowList();

        if (!empty($sharableAllowList)) {
            $sharableSocials = array_intersect_key(
                $sharableSocials,
                array_flip(ConfigManager::getSharableAllowList()),
            );
        }

        return array_map(
            function (array $social): object {
                $social = $this->setSharerUrl($social);
                $social = $this->setSharableOnClicks($social);
                $social = $this->setIconFullName($social);
                return (object) array_intersect_key($social, array_flip($this->allowedSocialItemKeys));
            },
            $sharableSocials,
        );
    }

    private function getFilteredSocials(array $registeredSocials): array
    {
        if (empty($registeredSocials)) {
            return [];
        }

        $sharableSocials = array_replace_recursive(
            $registeredSocials,
            array_intersect_key($this->getDefinedSocials(), $registeredSocials),
        );

        $allowedSharables = ConfigManager::getSocials();
        if (!empty($allowedSharables)) {
            $sharableSocials = array_intersect_key($sharableSocials, array_flip(array_keys(($allowedSharables))));
        }

        $sharableSocials =  array_map(
            fn (array $social): array => $this->setHtmlClass($social),
            $sharableSocials,
        );

        return $sharableSocials;
    }

    private function setHtmlClass(array $social): array
    {
        if (empty($social['key'])) {
            return $social;
        }

        $social['html']['attributes']['class'] ??= '';
        $social['html']['attributes']['class'] .= "acorn-social-icon acorn-social-icon-{$social['key']}";
        return $social;
    }

    private function setSharableOnClicks(array $social): array
    {
        //phpcs:ignore Generic.Files.LineLength.TooLong
        if (empty($social['placeholders']) || !in_array('url', $social['placeholders'], true) || empty($social['url'])) {
            return $social;
        }
        $social['html']['attributes']['onclick'] =  "window.open('{$social['url']}', '_blank');";

        return $social;
    }

    private function setIconFullName(array $social): array
    {
        if (empty($social['social_icon_name']) || empty($social['social_icon_style'])) {
            return $social;
        }

        $social['icon'] = "fa{$social['social_icon_style']}-{$social['social_icon_name']}";

        return $social;
    }

    private function setSharerUrl(array $social): array
    {
        if (!is_singular() || empty($social['sharer_url']) || empty($social['placeholders'])) {
            return $social;
        }

        $sharerUrl = $social['sharer_url'];
        $placeHolders = $social['placeholders'];
        foreach ($placeHolders as $placeHolder) {
            $sharerUrl = preg_replace(
                '/{{\s*' . $placeHolder . '\s*}}/',
                rawurlencode($this->getPlaceHolderFunc($placeHolder)()),
                $sharerUrl,
            );
        }

        $social['url'] = $sharerUrl;

        return $social;
    }

    private function setSocialPageUrl(array $social): array
    {
        if (empty($social['social_page_url'])) {
            return $social;
        }

        $social['url'] = $social['social_page_url'];

        return $social;
    }

    private function getPlaceHolderFunc(string $expression): callable
    {
        return match ($expression) {
            'url' => fn(): string => (string) get_permalink(),
            'title' =>  fn(): string => (string) get_the_title(),
            'summary' => fn(): string => function_exists('get_field')
                ? ((string) get_field('summary', get_the_ID())) : __return_empty_string(),
            default => '__return_empty_string',
        };
    }
}
