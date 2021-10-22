<template>
    <div class="modal fade" id="customModal" ref="modalRef" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 v-if="campaignData">{{campaignData.name}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 v-if="isLoading">Loading....</h4>
                    <div v-else>
                        <div v-for="(data,index) in dataImages" :key="index">
                            <img class="img-thumbnail" :ref="elem => {imgRefs[index] = elem}" alt="text">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import { onUpdated, watch, ref, onMounted, onBeforeUpdate, computed } from 'vue';
    import {Modal} from 'bootstrap';
    import Service from '../services/CampaignService'

    export default {
        name: "Preview",
        props: ['data'],
        setup(props){

            const isLoading = ref(true);
            const modalRef = ref(null);
            const campaignData = ref(null);

            let modal = null;
            const { load} = Service.getCampaignImages();
            const dataImages = ref([]);
            let imgRefs = ref([])
            let temUrls = [];

            onBeforeUpdate(()=>{
                imgRefs.value = [];
            });

            onUpdated(()=>{
                campaignData.value = props.data;
            });

            watch(campaignData,()=>{
                if(props.data){
                    campaignData.value = props.data;
                    isLoading.value = true;
                    temUrls = [];
                    modal.show();

                    dataImages.value = props.data.images; // get all campaign image url

                     load(dataImages.value,(index,localU, success)=>{
                         if(success){
                             temUrls.push(localU);
                         }

                         if((index + 1) === dataImages.value.length){ //all images has been downloaded
                             isLoading.value = false;
                             setTimeout(()=> {
                                 temUrls.forEach((item,currentIndex)=>{
                                     imgRefs.value[currentIndex].src = item;
                                 });

                             },100);
                         }


                     });


                }
            });

            onMounted(() => {
                modalRef.value.addEventListener('hidden.bs.modal',()=>{
                });
                modal = new Modal(modalRef.value);
            });


            return { isLoading, modalRef, dataImages,imgRefs,campaignData };
        }
    }
</script>

<style scoped>

</style>
