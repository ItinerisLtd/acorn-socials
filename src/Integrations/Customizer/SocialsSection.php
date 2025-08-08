<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Integrations\Customizer;

use Itineris\AcornSocials\Concretes\AbstractSection;
use Kirki\Field\Repeater;

final class SocialsSection extends AbstractSection
{
    public const SECTION_ID = 'socials';

    public const SECTION_TITLE = 'Socials';

    public const SECTION_DESCRIPTION = 'Social settings';

    public const SOCIAL_NETWORKS = 'social_networks';

    public function registerFields(): void
    {
        new Repeater(
            [
                'settings' => static::SOCIAL_NETWORKS,
                'label' => esc_attr__('Social Networks', 'itineris'),
                'section' => $this->getSection(),
                'priority' => 10,
                'row_label' => [
                    'type' => 'field',
                    'value' => esc_html__('Social', 'itineris'),
                    'field' => 'name',
                ],
                'fields' => [
                    'name' => [
                        'type' => 'text',
                        'label' => esc_attr__('Name', 'itineris'),
                        'default' => 'Facebook',
                    ],
                    'url' => [
                        'type' => 'link',
                        'label' => esc_attr__('Page URL', 'itineris'),
                        'description' => __('The URL used to link to the social network page', 'itineris'),
                        'default' => 'https://facebook.com',
                    ],
                    'icon_name' => [
                        'type' => 'text',
                        'label' => esc_html__('Icon', 'itineris'),
                        'description' =>  __('To get the icon, please search for an icon at
                            <a href="https://fontawesome.com/search" style="text-decoration: underline"
                            target="_blank" rel="noopener">https://fontawesome.com/</a>
                            (eg. <a href="https://fontawesome.com/search?q=facebook&ip=brands&o=r" target="_blank"
                            rel="noopener" style="text-decoration: underline">
                            https://fontawesome.com/search?q=facebook&ip=brands&o=r</a>),
                            then copy the alias of icon (in the bottom, under yellow button - copy left parameter with
                            name which is in a green background for example <div style="background-color: #63e6be;
                            border-radius: 0.75em;letter-spacing: 0.0625em;padding: 0.2em 1em;display: inline-block;
                            font-weight:bold;font-style: normal;">facebook</div>) if there
                            is no alias just copy name e.g. facebook. If alias is not working,
                            try using the name instead.', 'itineris'),
                        'default' => 'facebook',
                    ],
                ],
            ],
        );
    }
}
