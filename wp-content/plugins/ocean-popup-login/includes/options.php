<?php
/**
 * OceanWP Customizer Class: Popup Login
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Options
 */
function opl_customizer_options() {

    $options = [
        'title' => __( 'Popup Login', 'ocean-popup-login' ),
        'priority' => 12,
        'options' => [
            'opl_popup_login_position' => [
                'id'                => 'opl_popup_login_position',
                'type'              => 'ocean-buttons',
                'label'             => esc_html__( 'Position', 'ocean-popup-login' ),
                'desc'              => sprintf( esc_html__( 'Need help with the Manual position display method? Check out the documentation: %1$s how to display the popup login link %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/499-how-to-show-popup-login-link" target="_blank">', '</a>' ),
                'section'           => 'ocean_popup_login_settings',
                'default'           => 'menu',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'wrap'              => false,
                'sanitize_callback' => 'sanitize_key',
                'choices'           => [
                    'menu'  => [
                        'id'      => 'menu',
                        'label'   => esc_html__( 'Menu', 'ocean-popup-login' ),
                        'content' => esc_html__( 'Menu', 'ocean-popup-login' ),
                    ],
                    'manual'  => [
                        'id'      => 'manual',
                        'label'   => esc_html__( 'Manual', 'ocean-popup-login' ),
                        'content' => esc_html__( 'Manual', 'ocean-popup-login' ),
                    ]
                ]
            ],

            'opl_popup_login_title_for_logged_in_and_logged_out' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Logged In / Logged Out', 'ocean-popup-login' ),
				'section'   => 'ocean_popup_login_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

            'opl_popup_login_text' => [
                'label'             => esc_html__( 'Login Text', 'ocean-popup-login' ),
                'type'              => 'ocean-text',
                'section'           => 'ocean_popup_login_settings',
                'transport'         => 'postMessage',
                'default'           => esc_html__( 'Sign in / Join', 'ocean-popup-login' ),
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'wp_kses_post',
            ],

            'opl_divider_after_popup_login_text_setting' => [
                'type'      => 'ocean-divider',
                'section'   => 'ocean_popup_login_settings',
                'transport' => 'postMessage',
                'priority'  => 10,
                'top'       => 10,
                'bottom'    => 10
            ],

			'opl_popup_login_logged_in' => [
                'id'                => 'opl_popup_login_logged_in',
                'type'              => 'ocean-select',
                'label'             => esc_html__( 'Logged In', 'ocean-popup-login' ),
                'desc'              => esc_html__( 'Display this content when the user is logged in.', 'ocean-popup-login' ),
                'section'           => 'ocean_popup_login_settings',
                'transport'         => 'refresh',
                'default'           => 'logout',
                'priority'          => 10,
                'hideLabel'         => false,
                'multiple'          => false,
                'sanitize_callback' => 'sanitize_key',
                'choices'           => [
                    'nothing' => esc_html__( 'Display nothing', 'ocean-popup-login' ),
                    'logout'  => esc_html__( 'Logout link', 'ocean-popup-login' ),
                    'custom'  => esc_html__( 'Custom', 'ocean-popup-login' ),
                ]
            ],

            'opl_popup_login_logged_in_custom' => [
                'label'             => esc_html__( 'Custom Text', 'ocean-popup-login' ),
                'type'              => 'ocean-text',
                'section'           => 'ocean_popup_login_settings',
                'transport'         => 'refresh',
                'default'           => esc_html__( '', 'ocean-popup-login' ),
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'wp_kses_post',
                'active_callback'   => 'opl_popup_login_cac_has_custom_text'
            ],

			'opl_spacer_before_logout_text' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_popup_login_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

            'opl_popup_logout_text' => [
                'label'             => esc_html__( 'Logout Text', 'ocean-popup-login' ),
                'type'              => 'ocean-text',
                'section'           => 'ocean_popup_login_settings',
                'transport'         => 'refresh',
                'default'           => esc_html__( 'Logout', 'ocean-popup-login' ),
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'wp_kses_post'
            ],

			'opl_spacer_before_logout_url' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_popup_login_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

            'opl_popup_logout_url' => [
                'label'             => esc_html__( 'Logout URL', 'ocean-popup-login' ),
                'type'              => 'ocean-text',
                'section'           => 'ocean_popup_login_settings',
                'transport'         => 'refresh',
                'default'           => esc_html__( '', 'ocean-popup-login' ),
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'wp_kses_post'
            ],

            'opl_popup_login_title_for_loigin_form' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Forms', 'ocean-popup-login' ),
				'section'   => 'ocean_popup_login_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
                'top'       => 20,
                'bottom'    => 20,
			],

            'opl_login_form_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Login Form', 'ocean-popup-login' ),
                'section'  => 'ocean_popup_login_settings',
                'after'    => 'opl_popup_login_title_for_loigin_form',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
                    'opl_popup_login_text_title' => [
                        'label'    => esc_html__( 'Title', 'ocean-popup-login' ),
                        'type'     => 'ocean-text',
                        'section'  => 'opl_login_form_section',
                        'transport' => 'postMessage',
                        'default'   => esc_html__( 'Log in', 'ocean-popup-login' ),
                        'priority' => 10,
                        'hideLabel' => false,
                        'sanitize_callback' => 'wp_kses_post'
                    ],

                    'opl_popup_login_text_content' => [
                        'type'              => 'ocean-textarea',
                        'label'             => esc_html__( 'Content', 'ocean-popup-login' ),
                        'section'           => 'opl_login_form_section',
                        'transport'         => 'postMessage',
                        'default'           => esc_html__( 'Become a part of our community!', 'ocean-popup-login' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post'
                    ],

                    'opl_divider_after_popup_login_text_content_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_login_form_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 10,
                    ],

                    'opl_popup_login_redirect' => [
                        'label'             => esc_html__( 'Redirect After Login', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Add a desired URL if you want to redirect the user to a specific page after a successful login.', 'ocean-popup-login' ),
                        'type'              => 'ocean-text',
                        'section'           => 'opl_login_form_section',
                        'transport'         => 'postMessage',
                        'default'           => esc_html__( '', 'ocean-popup-login' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post',
                    ],

                    'opl_divider_after_popup_login_redirect_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_login_form_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 1,
                    ],

                    'opl_popup_hide_remember_me' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Hide the Remember Me option?', 'ocean-popup-login' ),
                        'section'           => 'opl_login_form_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_popup_login_forms_content_for_need_help_link' => [
                        'type'      => 'ocean-content',
                        'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login#Login-Form-aLY75/" target="_blank">', '</a>' ),
                        'class'     => 'need-help',
                        'section'   => 'opl_login_form_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],
                ]
            ],

            'opl_spacer_for_register_form_section' => [
                'type'      => 'ocean-spacer',
                'section'   => 'ocean_popup_login_settings',
                'transport' => 'postMessage',
                'priority'  => 10,
                'bottom'    => 10,
            ],

            'opl_register_form_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Register Form', 'ocean-popup-login' ),
                'section'  => 'ocean_popup_login_settings',
                'after'    => 'opl_spacer_for_register_form_section',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
                    'opl_popup_register_text_title' => [
                        'label'             => esc_html__( 'Title', 'ocean-popup-login' ),
                        'type'              => 'ocean-text',
                        'section'           => 'opl_register_form_section',
                        'transport'         => 'postMessage',
                        'default'           => esc_html__( 'Create an account', 'ocean-popup-login' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post',
                    ],

                    'opl_popup_register_text_content' => [
                        'type'              => 'ocean-textarea',
                        'label'             => esc_html__( 'Content', 'ocean-popup-login' ),
                        'section'           => 'opl_register_form_section',
                        'transport'         => 'postMessage',
                        'default'           => esc_html__( 'Welcome! Register for an account', 'ocean-popup-login' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post',
                    ],

                    'opl_divider_after_popup_register_text_content_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_register_form_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 10,
                    ],

					'opl_popup_registration_agreement_toggle' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Require Agreement', 'ocean-popup-login' ),
                        'section'           => 'opl_register_form_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'active_callback'   => 'opl_is_privacy_policy_set',
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_popup_registration_agreement_text' => [
                        'type'              => 'ocean-textarea',
                        'label'             => esc_html__( 'User Agreement Prompt', 'ocean-popup-login' ),
                        'desc'              => function_exists( 'opl_is_privacy_policy_set' )
                                            ? __( 'If Require Agreement option is enabled, new users will be required to check an agreement box in order to complete their account registration. You must have a published Privacy Policy page for this feature to function. Add the user agreement text below.', 'ocean-popup-login' )
                                            : __( 'Publish the Privacy Policy (see Settings -> Privacy) to enable this feature.', 'ocean-popup-login' ),
                        'section'           => 'opl_register_form_section',
                        'transport'         => 'postMessage',
                        'default'           => sprintf( esc_html__( 'I have read and agree with the %1$s Privacy Policy/Terms and Conditions %2$s', 'ocean-popup-login' ), '<a href="' . get_permalink( get_option( 'wp_page_for_privacy_policy' ) ) . '">', '</a>' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post',
                    ],

                    'opl_divider_after_popup_registration_agreement_toggle_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_register_form_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 10,
                    ],

                    'opl_popup_register_redirect' => [
                        'label'             => esc_html__( 'Redirect After Registration', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Add a desired URL if you want to redirect the user to a specific page after a successful account registration.', 'ocean-popup-login' ),
                        'type'              => 'ocean-text',
                        'section'           => 'opl_register_form_section',
                        'transport'         => 'postMessage',
                        'default'           => esc_html__( '', 'ocean-popup-login' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post',
                    ],

					'opl_title_for_mailchimp_subscribe_settings' => [
						'type'      => 'ocean-title',
						'label'     => esc_html__( 'MailChimp Subscribe', 'ocean-popup-login' ),
						'section'   => 'opl_register_form_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 20,
						'bottom'    => 20,
					],

					'opl_user_subscribe_mailchimp' => [
						'type'              => 'ocean-switch',
						'label'             => esc_html__( 'Enable Subscription', 'ocean-popup-login' ),
						'section'           => 'opl_register_form_section',
						'default'           => false,
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => 'oceanwp_sanitize_checkbox',
					],

					'opl_user_subscribe_mailchimp_text' => [
						'label'             => esc_html__( 'Subscription Text', 'ocean-popup-login' ),
						'type'              => 'ocean-text',
						'section'           => 'opl_register_form_section',
						'transport'         => 'postMessage',
						'default'           => esc_html__( 'Join our newsletter', 'ocean-popup-login' ),
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => 'wp_kses_post',
						'active_callback'   => 'opl_cac_has_mailchimp_subscribe'
					],

                    'opl_popup_register_forms_content_for_need_help_link' => [
                        'type'      => 'ocean-content',
                        'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login#Register-Form-KJ9pq/" target="_blank">', '</a>' ),
                        'class'     => 'need-help',
                        'section'   => 'opl_register_form_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],
                ]
            ],

            'opl_spacer_for_lost_password_section' => [
                'type'      => 'ocean-spacer',
                'section'   => 'ocean_popup_login_settings',
                'transport' => 'postMessage',
                'priority'  => 10,
                'bottom'    => 10,
            ],

            'opl_popup_lost_password_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Lost Password Form', 'ocean-popup-login' ),
                'section'  => 'ocean_popup_login_settings',
                'after'    => 'opl_spacer_for_lost_password_section',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
                    'opl_popup_lost_password_text_title' => [
                        'label'             => esc_html__( 'Title', 'ocean-popup-login' ),
                        'type'              => 'ocean-text',
                        'section'           => 'opl_popup_lost_password_section',
                        'transport'         => 'postMessage',
                        'default'           => esc_html__( 'Reset password', 'ocean-popup-login' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post',
                    ],

                    'opl_popup_lost_password_text_content' => [
                        'type'              => 'ocean-textarea',
                        'label'             => esc_html__( 'Content', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_lost_password_section',
                        'transport'         => 'postMessage',
                        'default'           => esc_html__( 'Recover your password', 'ocean-popup-login' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post',
                    ],

                    'opl_popup_lost_password_forms_content_for_need_help_link' => [
                        'type'      => 'ocean-content',
                        'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login#Lost-Password-V0xLI/" target="_blank">', '</a>' ),
                        'class'     => 'need-help',
                        'section'   => 'opl_popup_lost_password_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],
                ]
            ],

            'opl_popup_login_title_for_security_options' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Security Options', 'ocean-popup-login' ),
				'section'   => 'ocean_popup_login_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
                'top'       => 20,
                'bottom'    => 20,
			],

            'opl_username_security_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Username Security', 'ocean-popup-login' ),
                'section'  => 'ocean_popup_login_settings',
                'after'    => 'opl_popup_login_title_for_security_options',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
                    'opl_popup_username_enable_limit' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Limit Length of Usernames', 'ocean-popup-login' ),
                        'section'           => 'opl_username_security_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_popup_username_min_length' => [
                        'label'             => esc_html__( 'Min Username Length', 'ocean-popup-login' ),
                        'type'              => 'ocean-range-slider',
                        'section'           => 'opl_username_security_section',
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'isUnit'            => false,
                        'isResponsive'      => false,
                        'min'               => 2,
                        'max'               => 100,
                        'step'              => 1,
                        'sanitize_callback' => 'oceanwp_sanitize_number_blank',
                        'setting_args'      => [
                            'desktop' => [
                                'id'    => 'opl_popup_username_min_length',
                                'label' => esc_html__( 'Desktop', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 6,
                                ],
                            ]
                        ]
                    ],

                    'opl_popup_username_max_length' => [
                        'label'             => esc_html__( 'Max Username Length', 'ocean-popup-login' ),
                        'type'              => 'ocean-range-slider',
                        'section'           => 'opl_username_security_section',
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'isUnit'            => false,
                        'isResponsive'      => false,
                        'min'               => 2,
                        'max'               => 100,
                        'step'              => 1,
                        'sanitize_callback' => 'oceanwp_sanitize_number_blank',
                        'setting_args'      => [
                            'desktop' => [
                                'id'    => 'opl_popup_username_max_length',
                                'label' => esc_html__( 'Desktop', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 15,
                                ],
                            ]
                        ]
                    ],

                    'opl_divider_after_popup_username_max_length_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_username_security_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 10,
                    ],

                    'opl_popup_username_forbid_spaces' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Usernames Cannot Contain Spaces', 'ocean-popup-login' ),
                        'section'           => 'opl_username_security_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_divider_after_popup_username_forbid_spaces_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_username_security_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 10,
                    ],

                    'opl_popup_username_words_forbidden' => [
                        'label'             => esc_html__( 'Forbidden Usernames', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Separate with comma only. Do not use spaces. Example: admin,administrator,webmaster', 'ocean-popup-login' ),
                        'type'              => 'ocean-text',
                        'section'           => 'opl_username_security_section',
                        'transport'         => 'postMessage',
                        'default'           => esc_html__( '', 'ocean-popup-login' ),
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'wp_kses_post',
                    ],

                    'opl_popup_username_security_content_for_need_help_link' => [
                        'type'      => 'ocean-content',
                        'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login#Username-Security-aB7ws/" target="_blank">', '</a>' ),
                        'class'     => 'need-help',
                        'section'   => 'opl_username_security_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],
                ]
            ],

            'opl_spacer_for_popup_security_section' => [
                'type'      => 'ocean-spacer',
                'section'   => 'ocean_popup_login_settings',
                'transport' => 'postMessage',
                'priority'  => 10,
                'bottom'    => 10,
            ],

            'opl_popup_password_security_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Password Security', 'ocean-popup-login' ),
                'section'  => 'ocean_popup_login_settings',
                'after'    => 'opl_spacer_for_popup_security_section',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
                    'opl_popup_enforce_secure_password' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Require Secure Passwords', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Password length must be between 8 and 50 characters.', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_password_security_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_popup_password_security_title_for_password_content' => [
                        'type'      => 'ocean-title',
                        'label'     => esc_html__( 'Password Content', 'ocean-popup-login' ),
                        'section'   => 'opl_popup_password_security_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 20,
                        'bottom'    => 20,
                    ],

                    'opl_popup_enforce_number_password' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Must Contain Numbers', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Require at least one number in password.', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_password_security_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_divider_after_popup_enforce_number_password_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_password_security_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 10,
                    ],

                    'opl_popup_enforce_smalll_password' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Must Contain Small Letters', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Require at least one small letter in password.', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_password_security_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_divider_after_popup_enforce_smalll_password_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_password_security_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 10,
                    ],

                    'opl_popup_enforce_capsl_password' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Must Contain Capital Letters', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Require at least one capital letter in password.', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_password_security_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_divider_after_popup_enforce_capsl_password_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_password_security_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 10,
                    ],

                    'opl_popup_enforce_specch_password' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Must Contain Symbols', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Require at least one special character in password.', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_password_security_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_popup_pass_security_content_for_need_help_link' => [
                        'type'      => 'ocean-content',
                        'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login#Password-Security-M2hLG/" target="_blank">', '</a>' ),
                        'class'     => 'need-help',
                        'section'   => 'opl_popup_password_security_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],
                ]
            ],

            'opl_spacer_for_popup_blocking_section' => [
                'type'      => 'ocean-spacer',
                'section'   => 'ocean_popup_login_settings',
                'transport' => 'postMessage',
                'priority'  => 10,
                'bottom'    => 10,
            ],

            'opl_popup_blocking_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Blocking Options', 'ocean-popup-login' ),
                'section'  => 'ocean_popup_login_settings',
                'after'    => 'opl_spacer_for_popup_blocking_section',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
                    'opl_popup_enable_attempts_blocking' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Block on Invalid Login Attempts', 'ocean-popup-login' ),
                        'desc'              => esc_html__( 'Block users after multiple failed login attempts.', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_blocking_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_popup_divider_after_enable_attempts_blocking' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_blocking_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],

                    'opl_popup_number_of_attempts' => [
                        'label'             => esc_html__( 'Number of Invalid Attempts', 'ocean-popup-login' ),
                        'type'              => 'ocean-range-slider',
                        'section'           => 'opl_popup_blocking_section',
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'isUnit'            => false,
                        'isResponsive'      => false,
                        'min'               => 0,
                        'max'               => 100,
                        'step'              => 1,
                        'sanitize_callback' => 'oceanwp_sanitize_number_blank',
                        'setting_args'      => [
                            'desktop' => [
                                'id'    => 'opl_popup_number_of_attempts',
                                'label' => esc_html__( 'Desktop', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ]
                        ]
                    ],

                    'opl_popup_minutes_to_block' => [
                        'label'             => esc_html__( 'Block Duration (minutes)', 'ocean-popup-login' ),
                        'type'              => 'ocean-range-slider',
                        'section'           => 'opl_popup_blocking_section',
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'isUnit'            => false,
                        'isResponsive'      => false,
                        'min'               => 0,
                        'max'               => 1000,
                        'step'              => 1,
                        'sanitize_callback' => 'oceanwp_sanitize_number_blank',
                        'setting_args'      => [
                            'desktop' => [
                                'id'    => 'opl_popup_minutes_to_block',
                                'label' => esc_html__( 'Desktop', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 30,
                                ],
                            ]
                        ]
                    ],

                    'opl_popup_blocking_security_content_for_need_help_link' => [
                        'type'      => 'ocean-content',
                        'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login#Blocking-Options-6J2S6/" target="_blank">', '</a>' ),
                        'class'     => 'need-help',
                        'section'   => 'opl_popup_blocking_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],
                ]
            ],

            'opl_spacer_for_popup_validation_section' => [
                'type'      => 'ocean-spacer',
                'section'   => 'ocean_popup_login_settings',
                'transport' => 'postMessage',
                'priority'  => 10,
                'bottom'    => 10,
            ],

            'opl_popup_validation_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Validation Method', 'ocean-popup-login' ),
                'section'  => 'ocean_popup_login_settings',
                'after'    => 'opl_spacer_for_popup_validation_section',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
                    'opl_popup_content_for_validation_section' => [
                        'type'      => 'ocean-content',
                        'isContent' => esc_html__( 'For optimal protection, we recommend using nonce security. This is the default method and is usually sufficient. If you encounter issues with nonce security (like session token expiration) due to your website caching options, switch to Google reCAPTCHA instead.', 'ocean-popup-login' ),
                        'class'     => 'description',
                        'section'   => 'opl_popup_validation_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],

                    'opl_popup_nonce_enable' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Use Nonce for Validation', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_validation_section',
                        'default'           => true,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_popup_recaptcha_enable' => [
                        'type'              => 'ocean-switch',
                        'label'             => esc_html__( 'Use reCAPTCHA for Validation', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_validation_section',
                        'default'           => false,
                        'transport'         => 'refresh',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'sanitize_callback' => 'oceanwp_sanitize_checkbox',
                    ],

                    'opl_popup_validation_content_for_need_help_link' => [
                        'type'      => 'ocean-content',
                        'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login#Validation-Method-28aOK/" target="_blank">', '</a>' ),
                        'class'     => 'need-help',
                        'section'   => 'opl_popup_validation_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],
                ]
            ],

            'opl_popup_login_title_for_styling_settings' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Styling', 'ocean-popup-login' ),
				'section'   => 'ocean_popup_login_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
                'top'       => 20,
                'bottom'    => 20,
			],

            'opl_popup_styling_section' => [
                'type'     => 'section',
                'title'    => esc_html__( 'Styling', 'ocean-popup-login' ),
                'section'  => 'ocean_popup_login_settings',
                'after'    => 'opl_popup_login_title_for_styling_settings',
                'class'    => 'section-site-layout',
                'priority' => 10,
                'options'  => [
					'opl_spacer_before_login_style_width' => [
						'type'      => 'ocean-spacer',
						'section'   => 'opl_popup_styling_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

                    'opl_popup_login_style_width' => [
                        'id'                => 'opl_popup_login_style_width',
                        'label'             => esc_html__( 'Width (px)', 'ocean-popup-login' ),
                        'type'              => 'ocean-range-slider',
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'isUnit'            => false,
                        'isResponsive'      => true,
                        'min'               => 10,
                        'max'               => 5000,
                        'step'              => 1,
                        'sanitize_callback' => 'oceanwp_sanitize_number_blank',
                        'setting_args'      => [
                            'desktop' => [
                                'id'    => 'opl_popup_login_style_width',
                                'label' => esc_html__( 'Desktop', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 500,
                                ],
                            ],
                            'tablet' => [
                                'id'    => 'opl_popup_login_style_width_tablet',
                                'label' => esc_html__( 'Tablet', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                            'mobile' => [
                                'id'    => 'opl_popup_login_style_width_mobile',
                                'label' => esc_html__( 'Mobile', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ],
                        'preview' => 'queryWithType',
                        'css'     => [
                            '#opl-login-form .opl-popup-block' => ['width']
                        ]
                    ],

					'opl_spacer_before_login_style_padding' => [
						'type'      => 'ocean-spacer',
						'section'   => 'opl_popup_styling_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

                    'opl_popup_login_style_padding_dimensions' => [
                        'id'           => 'opl_popup_login_style_padding_dimensions',
                        'label'        => esc_html__( 'Padding (px)', 'ocean-popup-login' ),
                        'type'         => 'ocean-spacing',
                        'section'      => 'opl_popup_styling_section',
                        'transport'    => 'postMessage',
                        'priority'     => 10,
                        'hideLabel'    => false,
                        'isType'       => 'padding',
                        'setting_args' => [
                            'spacingTop' => [
                                'id'    => 'opl_popup_login_style_top_padding',
                                'label' => esc_html__( 'Top', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 30,
                                ],
                            ],
                            'spacingRight' => [
                                'id'    => 'opl_popup_login_style_right_padding',
                                'label' => esc_html__( 'Right', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 100,
                                ],
                            ],
                            'spacingBottom' => [
                                'id'    => 'opl_popup_login_style_bottom_padding',
                                'label' => esc_html__( 'Bottom', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 30,
                                ],
                            ],
                            'spacingLeft' => [
                                'id'    => 'opl_popup_login_style_left_padding',
                                'label' => esc_html__( 'Left', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 100,
                                ],
                            ],
                            'spacingTopTablet' => [
                                'id'    => 'opl_popup_login_style_tablet_top_padding',
                                'label' => esc_html__( 'Top', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 30,
                                ],
                            ],
                            'spacingRightTablet' => [
                                'id'    => 'opl_popup_login_style_tablet_right_padding',
                                'label' => esc_html__( 'Right', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 100,
                                ],
                            ],
                            'spacingBottomTablet' => [
                                'id'    => 'opl_popup_login_style_tablet_bottom_padding',
                                'label' => esc_html__( 'Bottom', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 30,
                                ],
                            ],
                            'spacingLeftTablet' => [
                                'id'    => 'opl_popup_login_style_tablet_left_padding',
                                'label' => esc_html__( 'Left', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 100,
                                ],
                            ],
                            'spacingTopMobile' => [
                                'id'    => 'opl_popup_login_style_mobile_top_padding',
                                'label' => esc_html__( 'Top', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 30,
                                ],
                            ],
                            'spacingRightMobile' => [
                                'id'    => 'opl_popup_login_style_mobile_right_padding',
                                'label' => esc_html__( 'Right', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 50,
                                ],
                            ],
                            'spacingBottomMobile' => [
                                'id'    => 'opl_popup_login_style_mobile_bottom_padding',
                                'label' => esc_html__( 'Bottom', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 30,
                                ],
                            ],
                            'spacingLeftMobile' => [
                                'id'    => 'opl_popup_login_style_mobile_left_padding',
                                'label' => esc_html__( 'Left', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 50,
                                ],
                            ],
                        ],
                        'preview' => 'queryWithType',
                        'css'     => [
                            'selector' => '#opl-login-form .opl-popup-block',
                            'property' => 'padding',
                        ]
                    ],

					'opl_spacer_before_login_style_border_radius' => [
						'type'      => 'ocean-spacer',
						'section'   => 'opl_popup_styling_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

                    'opl_popup_login_style_border_radius' => [
                        'id'           => 'opl_popup_login_style_border_radius',
                        'label'        => esc_html__( 'Border Radius (px)', 'ocean-popup-login' ),
                        'type'         => 'ocean-spacing',
                        'section'      => 'opl_popup_styling_section',
                        'transport'    => 'postMessage',
                        'priority'     => 10,
                        'hideLabel'    => false,
                        'isType'       => 'border-radius',
                        'setting_args' => [
                            'spacingTop' => [
                                'id'    => 'opl_popup_login_style_top_border_radius',
                                'label' => esc_html__( 'Top', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingRight' => [
                                'id'    => 'opl_popup_login_style_right_border_radius',
                                'label' => esc_html__( 'Right', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingBottom' => [
                                'id'    => 'opl_popup_login_style_bottom_border_radius',
                                'label' => esc_html__( 'Bottom', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingLeft' => [
                                'id'    => 'opl_popup_login_style_left_border_radius',
                                'label' => esc_html__( 'Left', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingTopTablet' => [
                                'id'    => 'opl_popup_login_style_tablet_top_border_radius',
                                'label' => esc_html__( 'Top', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingRightTablet' => [
                                'id'    => 'opl_popup_login_style_tablet_right_border_radius',
                                'label' => esc_html__( 'Right', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingBottomTablet' => [
                                'id'    => 'opl_popup_login_style_tablet_bottom_border_radius',
                                'label' => esc_html__( 'Bottom', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingLeftTablet' => [
                                'id'    => 'opl_popup_login_style_tablet_left_border_radius',
                                'label' => esc_html__( 'Left', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingTopMobile' => [
                                'id'    => 'opl_popup_login_style_mobile_top_border_radius',
                                'label' => esc_html__( 'Top', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingRightMobile' => [
                                'id'    => 'opl_popup_login_style_mobile_right_border_radius',
                                'label' => esc_html__( 'Right', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingBottomMobile' => [
                                'id'    => 'opl_popup_login_style_mobile_right_border_radius',
                                'label' => esc_html__( 'Bottom', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                            'spacingLeftMobile' => [
                                'id'    => 'opl_popup_login_style_mobile_left_border_radius',
                                'label' => esc_html__( 'Left', 'ocean-popup-login' ),
                                'attr'  => [
                                    'transport' => 'postMessage',
                                    'default'   => 3,
                                ],
                            ],
                        ],
                        'preview' => 'queryWithType',
                        'css'     => [
                            'selector' => '.woocommerce .products .product-inner',
                            'property' => 'border-radius',
                        ],
                    ],

                    'opl_divider_after_login_style_border_radius_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

                    'opl_popup_login_style_bg' => [
                        'label'     => esc_html__( 'Background Image', 'ocean-popup-login' ),
                        'type'      => 'ocean-image',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'hideLabel' => false,
                        'mediaType' => 'image',
                        'savetype'  => 'url',
                        'sanitize_callback' => 'ocean_sanitize_image_control'
                    ],

                    'opl_divider_after_login_style_bg_setting' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

					'opl_popup_login_style_overlay_bg_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Site Overlay', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_overlay_bg_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-overlay' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => 'rgba(11,11,11,.8)',
                                ],
                            ],
                        ]
                    ],

					'opl_divider_after_website_overlay_color' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

                    'opl_popup_login_style_bg_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Form Background', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_bg_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-popup-block' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#ffffff',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_style_title_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Title', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_title_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-title' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#333333',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_style_content_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Content', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_content_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-intro' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#777777',
                                ],
                            ],
                        ]
                    ],

					'opl_divider_after_content_color' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

                    'opl_popup_login_style_input_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Input Label', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_input_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .input-wrap .opl-label' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#757575',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_style_input_border_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Input Box Border', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_input_border_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .input-wrap .opl-line' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#dddddd',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_style_input_border_focus_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Input Box Border: Focus', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_input_border_focus_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .input-wrap .opl-focus-line' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ]
                    ],

					'opl_divider_after_input_border_color' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

                    'opl_popup_login_style_remember_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Remember Me', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_remember_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .input-wrap.opl-remember label' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#040404',
                                ],
                            ],
                        ]
                    ],

					'opl_divider_after_remember_me_color' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

                    'opl_popup_login_style_button_bg_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Button Background', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_button_bg_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Normal', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-button' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                            'hover' => [
                                'id'       => 'opl_popup_login_style_button_bg_color_hover',
                                'key'      => 'hover',
                                'label'    => esc_html__( 'Hover', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-button:hover' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_style_button_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Button Text', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_button_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-button' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#ffffff',
                                ],
                            ],
                        ]
                    ],

					'opl_divider_after_button_text_color' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

                    'opl_popup_login_style_forgot_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Forgot Password', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_forgot_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-text a' => 'color',
                                ],
                                'attr'    => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ]
                    ],

					'opl_divider_after_forgot_password_color' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

                    'opl_popup_login_style_bottom_bg_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Bottom Background', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id' => 'opl_popup_login_style_bottom_bg_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-bottom' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#f6f6f6',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_style_bottom_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Bottom Text', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_bottom_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Select Color', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-bottom .text' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#000000',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_style_bottom_button_bg_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Bottom Button Background', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_bottom_button_bg_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Normal', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-bottom .opl-btn' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#ffffff',
                                ],
                            ],
                            'hover' => [
                                'id'       => 'opl_popup_login_style_bottom_button_hover_bg_color',
                                'key'      => 'hover',
                                'label'    => esc_html__( 'Hover', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-bottom .opl-btn:hover' => 'background-color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_style_bottom_button_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Bottom Button Text', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_style_bottom_button_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Normal', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-bottom .opl-btn' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                    'default'   => '#1f1f1f',
                                ],
                            ],
                            'hover' => [
                                'id'       => 'opl_popup_login_style_bottom_button_hover_color',
                                'key'      => 'hover',
                                'label'    => esc_html__( 'Hover', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-bottom .opl-btn:hover' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ]
                    ],

					'opl_divider_after_before_prvicy_policy' => [
                        'type'      => 'ocean-divider',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                        'top'       => 10,
                        'bottom'    => 20,
                    ],

                    'opl_popup_login_privacy_color' => [
                        'type'              => 'ocean-color',
                        'label'             => esc_html__( 'Privacy Link', 'ocean-popup-login' ),
                        'section'           => 'opl_popup_styling_section',
                        'transport'         => 'postMessage',
                        'priority'          => 10,
                        'hideLabel'         => false,
                        'showAlpha'         => true,
                        'showPalette'       => true,
                        'sanitize_callback' => 'wp_kses_post',
                        'setting_args'      => [
                            'normal' => [
                                'id'       => 'opl_popup_login_privacy_color',
                                'key'      => 'normal',
                                'label'    => esc_html__( 'Normal', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-privacy a' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                            'hover' => [
                                'id'       => 'opl_popup_login_privacy_hover_color',
                                'key'      => 'hover',
                                'label'    => esc_html__( 'Hover', 'ocean-popup-login' ),
                                'selector' => [
                                    '#opl-login-form .opl-privacy a:hover' => 'color',
                                ],
                                'attr'     => [
                                    'transport' => 'postMessage',
                                ],
                            ],
                        ]
                    ],

                    'opl_popup_login_styling_content_for_need_help_link' => [
                        'type'      => 'ocean-content',
                        'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login#Styling-PgqBF/" target="_blank">', '</a>' ),
                        'class'     => 'need-help',
                        'section'   => 'opl_popup_styling_section',
                        'transport' => 'postMessage',
                        'priority'  => 10,
                    ],
                ]
            ],

            'opl_popup_login_content_for_need_help_link' => [
                'type'      => 'ocean-content',
                'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-popup-login' ), '<a href="https://docs.oceanwp.org/article/914-customizer-popup-login/" target="_blank">', '</a>' ),
                'class'     => 'need-help',
                'section'   => 'ocean_popup_login_settings',
                'transport' => 'postMessage',
                'priority'  => 10,
            ],
        ]
    ];

    return apply_filters( 'opl_customizer_options', $options );
}
