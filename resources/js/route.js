import { createRouter, createWebHistory } from 'vue-router'
import Home from "./views/Home";
import AddCampaign from "./views/AddCampaign";
import EditCampaign from "./views/EditCampaign";

const routes = [
    {
        path:'/',
        name:'Home',
        component: Home
    },
    {
        path:'/add-campaign',
        name:'Add Campaign',
        component: AddCampaign
    },
    {
        path:'/edit-campaign',
        name:'Edit Campaign',
        component: EditCampaign,
        props:true
    }
];

const router = createRouter({
        history: createWebHistory(process.env.BASE_URL),
        routes
    }
);

export default router;
