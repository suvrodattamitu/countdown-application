import { createWebHashHistory, createRouter } from "vue-router";

import GlobalView from '../Global';
import CountdownEditor from '../components/CountdownEditor';
import SupportAndDocs from '../components/SupportAndDocs';
import AllCountdowns from '../components/AllCountdowns';

const routes = [
    {   
        path: '/',
        component: GlobalView,
        props: true,
        children: [
            {
                path: '/',
                name: 'all-countdowns',
                component: AllCountdowns,
                meta: { title: 'All Countdowns' }
            },
            {
                path: '/support',
                name: 'support',
                component: SupportAndDocs,
                meta: { title: 'Support' }
            }
        ],
    },
    {
        path: '/countdown-editor/:countdown_id',
        name: 'countdown-editor',
        component: CountdownEditor,
        meta: { title: 'Countdown Editor' }
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if(to.meta){
        document.title = 'Ninja Countdown :: ' + to.meta.title;
    }else{
        document.title = 'Ninja Countdown';
    }

    next();
});

export default router;