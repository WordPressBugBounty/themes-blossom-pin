import { Icon, Sidebar, Card, Heading } from "../../components";
import { __ } from '@wordpress/i18n';

const Homepage = () => {
    const cardLists = [
        {
            iconSvg: <Icon icon="site" />,
            heading: __('Site Identity', 'blossom-pin'),
            buttonText: __('Customize', 'blossom-pin'),
            buttonUrl: cw_dashboard.custom_logo
        },
        {
            iconSvg: <Icon icon="colorsetting" />,
            heading: __("Color Settings", 'blossom-pin'),
            buttonText: __('Customize', 'blossom-pin'),
            buttonUrl: cw_dashboard.colors
        },
        {
            iconSvg: <Icon icon="layoutsetting" />,
            heading: __("Layout Settings",'blossom-pin'),
            buttonText: __('Customize', 'blossom-pin'),
            buttonUrl: cw_dashboard.layout
        },
        {
            iconSvg: <Icon icon="instagramsetting" />,
            heading: __("Instagram Settings",'blossom-pin'),
            buttonText: __('Customize', 'blossom-pin'),
            buttonUrl: cw_dashboard.instagram
        },
        {
            iconSvg: <Icon icon="generalsetting" />,
            heading: __("General Settings",'blossom-pin'),
            buttonText: __('Customize', 'blossom-pin'),
            buttonUrl: cw_dashboard.general
        },
        {
            iconSvg: <Icon icon="footersetting" />,
            heading: __('Footer Settings','blossom-pin'),
            buttonText: __('Customize', 'blossom-pin'),
            buttonUrl: cw_dashboard.footer
        }
    ];

    const proSettings = [
        {
            heading: __('Header Layouts', 'blossom-pin'),
            para: __('Choose from different unique header layouts.', 'blossom-pin'),
            buttonText: __('Learn More', 'blossom-pin'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Layouts', 'blossom-pin'),
            para: __('Choose layouts for blogs, banners, posts and more.', 'blossom-pin'),
            buttonText: __('Learn More', 'blossom-pin'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Sidebar', 'blossom-pin'),
            para: __('Set different sidebars for posts and pages.', 'blossom-pin'),
            buttonText: __('Learn More', 'blossom-pin'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Sticky/Floating Menu', 'blossom-pin'),
            para: __('Show a sticky/floating Menu for the site', 'blossom-pin'),
            buttonText: __('Learn More', 'blossom-pin'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Boost your website performance with ease.', 'blossom-pin'),
            heading: __('Performance Settings', 'blossom-pin'),
            buttonText: __('Learn More', 'blossom-pin'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Choose typography for body and different heading tags.', 'blossom-pin'),
            heading: __('Advanced Typography Settings', 'blossom-pin'),
            buttonText: __('Learn More', 'blossom-pin'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Import the demo content to kickstart your site.', 'blossom-pin'),
            heading: __('One Click Demo Import', 'blossom-pin'),
            buttonText: __('Learn More', 'blossom-pin'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Easily place ads on high conversion areas.', 'blossom-pin'),
            heading: __('Advertisement Settings', 'blossom-pin'),
            buttonText: __('Learn More', 'blossom-pin'),
            buttonUrl: cw_dashboard?.get_pro
        },
    ];

    const sidebarSettings = [
        {
            heading: __('We Value Your Feedback!', 'blossom-pin'),
            icon: "star",
            para: __("Your review helps us improve and assists others in making informed choices. Share your thoughts today!", 'blossom-pin'),
            imageurl: <Icon icon="review" />,
            buttonText: __('Leave a Review', 'blossom-pin'),
            buttonUrl: cw_dashboard.review
        },
        {
            heading: __('Knowledge Base', 'blossom-pin'),
            para: __("Need help using our theme? Visit our well-organized Knowledge Base!", 'blossom-pin'),
            imageurl: <Icon icon="documentation" />,
            buttonText: __('Explore', 'blossom-pin'),
            buttonUrl: cw_dashboard.docmentation
        },
        {
            heading: __('Need Assistance? ', 'blossom-pin'),
            para: __("If you need help or have any questions, don't hesitate to contact our support team. We're here to assist you!", 'blossom-pin'),
            imageurl: <Icon icon="supportTwo" />,
            buttonText: __('Submit a Ticket', 'blossom-pin'),
            buttonUrl: cw_dashboard.support
        }
    ];

    return (
        <>
            <div className="customizer-settings">
                <div className="cw-customizer">
                    <div className="video-section">
                        <div className="cw-settings">
                            <h2>{__('Blossom Pin Tutorial', 'blossom-pin')}</h2>
                        </div>
                        <iframe src="https://www.youtube.com/embed/dvedO4cspEo?list=PLkJUvleBsFhfWFQRZFMC5kitJMCysL7ZZ" title={__( 'Create Pinterest Style WordPress Blog in 2023 | Blossom Pin')} frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerPolicy="strict-origin-when-cross-origin" allowFullScreen></iframe>
                    </div>
                    <Heading
                        heading={__('Quick Customizer Settings', 'blossom-pin')}
                        buttonText={__('Go To Customizer', 'blossom-pin')}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={cardLists}
                        cardPlace='customizer'
                        cardCol='three-col'
                    />
                    <Heading
                        heading={__('More features with Pro version', 'blossom-pin')}
                        buttonText={__('Go To Customizer', 'blossom-pin')}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={proSettings}
                        cardPlace='cw-pro'
                        cardCol='two-col'
                    />
                    <div className="cw-button">
                        <a href={cw_dashboard?.get_pro} target="_blank" className="cw-button-btn primary-btn long-button">{__('Learn more about the Pro version', 'blossom-pin')}</a>
                    </div>
                </div>
                <Sidebar sidebarSettings={sidebarSettings} openInNewTab={true} />
            </div>
        </>
    );
}

export default Homepage;