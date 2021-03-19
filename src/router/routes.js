import { createWebHashHistory, createRouter } from "vue-router"

import CountdownEditor from '../components/CountdownEditor'
import Settings from '../components/Settings'
import SupportAndDocs from '../components/SupportAndDocs'

const routes = [
    {
        path: '/',
        name: 'editor',
        component: CountdownEditor,
        meta: { title: 'Countdown Editor' }
    },
    {
        path: '/settings',
        name: 'settings',
        component: Settings,
        meta: { title: 'Settings' }
    },
    {
        path: '/support',
        name: 'support',
        component: SupportAndDocs,
        meta: { title: 'Support' }
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