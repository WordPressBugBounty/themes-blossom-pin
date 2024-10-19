import { Icon, Card } from "../../components";
import { __ } from "@wordpress/i18n";
import { mainDemo, demo2, demo3 } from "../../components/images";

const StarterSites = () => {
    const cardList = [
        {
            heading: __('Blossom Pin Pro', 'blossom-pin'),
            imageurl: mainDemo,
            buttonUrl: __('https://blossomthemesdemo.com/blossom-pin-pro/', 'blossom-pin'),
        },
        {
            heading: __('Fashion', 'blossom-pin'),
            imageurl: demo2,
            buttonUrl: __('https://blossomthemesdemo.com/pin-pro-fashion/', 'blossom-pin'),
        },
        {
            heading: __('Travel', 'blossom-pin'),
            imageurl: demo3,
            buttonUrl: __('https://blossomthemesdemo.com/pin-pro-travel/', 'blossom-pin'),
        },

    ]
    return (
        <>
            <Card
                cardList={cardList}
                cardPlace='starter'
                cardCol='three-col'
            />
            <div className="starter-sites-button cw-button">
                <a href={__( 'https://blossomthemes.com/theme-demo/?theme=blossom-pin-pro&utm_source=blossom_pin&utm_medium=dashboard&utm_campaign=theme_demo', 'blossom-pin' )} target="_blank" className="cw-button-btn outline">
                    {__('View All Demos', 'blossom-pin')}
                    <Icon icon="arrowtwo" />
                </a>
            </div>
        </>
    );
}

export default StarterSites;