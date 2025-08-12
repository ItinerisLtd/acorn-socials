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
        $itinerisUrl = 'https://www.itineris.co.uk/';

        new Repeater(
            [
                'settings' => static::SOCIAL_NETWORKS,
                'label' => esc_attr__('Social Networks and Social Sharing', 'itineris'),
                'section' => $this->getSection(),
                'priority' => 10,
                'row_label' => [
                    'type' => 'field',
                    'value' => esc_html__('Social', 'itineris'),
                    'field' => 'social_name',
                ],
                'default'  => [
                    [
                        'social_name'   => 'facebook',
                        'social_page_url'    =>  $itinerisUrl,
                        'is_social_sharable' => false,
                        'social_icon_name'    => 'square-facebook',
                        'social_icon_style' => 'b',
                    ],
                    [
                        'social_name'   => 'twitter',
                        'social_page_url'    =>  $itinerisUrl,
                        'is_social_sharable' => false,
                        'social_icon_name'    => 'square-x-twitter',
                        'social_icon_style'    => 'b',
                    ],
                    [
                        'social_name'   => 'email',
                        'social_page_url'    =>  '',
                        'is_social_sharable' => true,
                        'social_icon_name'    => 'envelope',
                        'social_icon_style'    => 'r',
                    ],
                ],
                'fields' => [
                    'social_name' => [
                        'type' => 'select',
                        'label' => esc_attr__('Social Name', 'itineris'),
                        'choices' => $this->getSocialNameDropdown(),
                        'default' => '',
                    ],
                    'social_page_url' => [
                        'type' => 'url',
                        'label' => esc_html__('Social Page Url', 'itineris'),
                        'default' => '',
                    ],
                    'is_social_sharable' => [
                        'type' => 'checkbox',
                        'label' => esc_html__('Is Sharable?', 'itineris'),
                        //phpcs:ignore Generic.Files.LineLength.TooLong
                        'description' => __('Toggle this on if this social should be used as sharer at singles', 'itineris'),
                        'default' => '',
                    ],
                    'social_icon_name' => [
                        'type' => 'text',
                        'label' => esc_html__('Icon Name', 'itineris'),
                        'description' => __('To get the icon, please search for an icon at
                            <a href="https://fontawesome.com/search" style="text-decoration: underline"
                            target="_blank" rel="noopener">https://fontawesome.com/</a>
                            (eg. <a href="https://fontawesome.com/icons/arrow-right?s=regular&f=classic" target="_blank"
                            rel="noopener" style="text-decoration: underline">
                            https://fontawesome.com/icons/arrow-right?s=regular&f=classic</a>),
                            then copy the alias of icon (in the bottom, under yellow button - copy left parameter with
                            name which is in a green background for example <div style="background-color: #63e6be;
                            border-radius: 0.75em;letter-spacing: 0.0625em;padding: 0.2em 1em;display: inline-block;
                            font-weight:bold;font-style: normal;">arrow-to-bottom</div>) if there
                            is no alias just copy name e.g. arrow-right. If alias is not working,
                            try using the name instead.', 'itineris'),
                        'default' => '',
                    ],
                    'social_icon_style' => [
                        'type' => 'select',
                        'label' => __('Icon style', 'itineris'),
                        'choices' => [
                            'r' => __('Regular', 'itineris'),
                            's' => __('Solid', 'itineris'),
                            'b' => __('Brands', 'itineris'),
                            'd' => __('Duotone', 'itineris'),
                            'l' => __('Light', 'itineris'),
                        ],
                        'default' => 'r',
                    ],
                ],
            ],
        );
    }
}
