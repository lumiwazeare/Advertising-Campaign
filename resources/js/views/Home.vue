<template>
 <section class="p-5">
     <div class="container-fluid">
         <div class="row">
             <div class="col-8">
                 <h4>Campaigns</h4>
                 Current campaign list
             </div>

             <div class="col-2 text-end">
                 <button class="p-1 btn btn-success" @click="showAddCampaignPage">+New Campaign</button>
             </div>
         </div>

         <div class="mt-5">
             <div v-if="data.length > 0">
                 <div class="card mt-4" v-for="campaign in computedCampaigns" :key="campaign.id">
                     <div class="row gy-3 card-body">
                         <div class="col">
                             <h6>{{campaign.name}}</h6>
                             <span class="small smaller">Created on {{campaign.created_at}}</span>
                         </div>
                         <div class="col">
                             <h6>${{campaign.daily_budget}}</h6>
                             <span class="small smaller">Daily Budget</span>
                         </div>
                         <div class="col">
                             <h6>${{campaign.total_budget}}</h6>
                             <span class="small smaller">Total Budget</span>
                         </div>
                         <div class="col">
                             <h6>{{campaign.start_date}}</h6>
                             <span class="small smaller">Start Date</span>
                         </div>
                         <div class="col">
                             <h6>{{campaign.end_date}}</h6>
                             <span class="small smaller">End Date</span>
                         </div>
                         <div class="col text-center">
                             <button class="p-1 btn btn-secondary btn-sm" @click="previewClick(campaign)">Preview</button>
                         </div>
                         <div class="col">
                             <button class="p-1 btn btn-success btn-sm" @click="editClick(campaign)">Edit</button>
                         </div>
                     </div>

                 </div>
             </div>

             <div class="text-center" v-else>
                 <h2>No Content Found</h2>
             </div>

         </div>
     </div>

     <Preview :data="selectedCampaign"/>
 </section>
</template>

<script>
    import { computed, ref } from 'vue';
    import { useRouter } from 'vue-router'
    import services from '../services/CampaignService';
    import Preview from "../components/Preview";

    export default {
        name: "Home",
        components: {Preview},
        setup(){

            const { data, load } = services.getCampaigns();
            const selectedCampaign = ref(null);
            load();
            const computedCampaigns = computed(() => {

                  return data.value.length > 0 ? data.value.map((current) => {
                      const camp = current;
                      camp.created_at = (new Date(camp.created_at)).toLocaleDateString();
                      camp.start_date = (new Date(camp.start_date)).toLocaleDateString();
                      camp.end_date = (new Date(camp.end_date)).toLocaleDateString();
                      return camp;
                  }) : [];
                }
            );

            let router = useRouter();

            const showAddCampaignPage = () => {
                router.push('/add-campaign');
            }

            const previewClick = (currentCampaign) => {
                selectedCampaign.value = currentCampaign;
            };

            const editClick = (currentCampaign) => {
                router.push({
                    name: 'Edit Campaign',
                    params:{
                        id: currentCampaign.id,
                        name: currentCampaign.name,
                        startDate: currentCampaign.start_date,
                        endDate: currentCampaign.end_date,
                        dailyBudget: currentCampaign.daily_budget,
                        totalBudget: currentCampaign.total_budget
                    }
                });
            };

            return { data, computedCampaigns, showAddCampaignPage, selectedCampaign, previewClick, editClick };
        }
    }
</script>

<style scoped>
    .smaller{
        font-size: 11px;
    }
</style>
