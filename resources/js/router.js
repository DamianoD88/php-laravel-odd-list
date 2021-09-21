import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

//./pages/Home : sa dove andarlo a predndere
import Home from './pages/Home';
import About from './pages/About';
import Post from './pages/Post';
import SinglePost from './pages/SinglePost';
import Contact from './pages/Contact';

const router = new VueRouter({
    mode: "history",
    //costruiamo le rotte
    routes: [
        {   
            //dentro cartella pages
            path: '/',
            name: "home",
            component: Home
        },
        {
            path: '/chi-siamo',
            name: "about",
            component: About
        },
        {
            path: '/posts',
            name: "post",
            component: Post
        },
        {
            path: '/post/:slug',
            name: "post-detail",
            component: SinglePost
        },
        {
            path: '/contatti',
            name: "contact",
            component: Contact
        }
    ]
});



export default router;