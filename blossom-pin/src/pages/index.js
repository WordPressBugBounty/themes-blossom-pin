import { useState } from 'react';
import { Icon, Tab } from '../components';
import FreePro from './FreePro';
import Homepage from "./Home";
import Offers from './Offers';
import UsefulPlugins from './UsefulPlugins';
import FAQ from './FAQ';
import StarterSites from './StarterSites';
import { __ } from '@wordpress/i18n';

function Dashboard() {
    const [activeTabTitle, setActiveTabTitle] = useState('Home');

    const tabsData = [
        {
            title: __('Home','blossom-pin'),
            icon: <Icon icon="home" />,
            content: <Homepage />
        },
        {
            title: __('Starter Sites','blossom-pin'),
            icon: <Icon icon="globe" />,
            content: <StarterSites />
        },
        {
            title: __('Free vs Pro','blossom-pin'),
            icon: <Icon icon="freePro" />,
            content: <FreePro />
        },
        {
            title: __('Offers','blossom-pin'),
            icon: <Icon icon="offers" />,
            content: <Offers />
        },
        {
            title: __('FAQs','blossom-pin'),
            icon: <Icon icon="support" />,
            content: <FAQ />
        },
        {
            title: __('Useful Plugins','blossom-pin'),
            icon: <Icon icon="plugins" />,
            content: <UsefulPlugins />
        }
    ];

    const handleTabChange = (title) => {
        setActiveTabTitle(title);
    };

    return (
        <>
            <Tab
                tabsData={tabsData}
                onChange={handleTabChange}
                activeTabTitle={activeTabTitle}
            />
        </>
    );
}

export default Dashboard;
