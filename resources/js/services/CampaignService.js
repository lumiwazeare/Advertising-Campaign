import { ref, computed } from 'vue';

const url = process.env.BASE_URL + '/api/';

export default {
    getCampaigns: () => {
        const data = ref([]);

        const load =  async () => {
            try{
                let response = await fetch('/api/campaigns');
                if(response.status === 200){
                    data.value = (await response.json()).data.records;
                }

            }
            catch (e) {}

        }

        return { data, load }
    },
    addCampaign: () => {
        const data = ref(null);
        const isLoading = ref(false);

        const load =  async (formData, callback) => {
            try{
                isLoading.value = true;
                let response = await fetch('/api/campaign/add', {
                    method:'POST',
                    body: formData
                });
                if(response.status === 200){
                    data.value = (await response.json()).data;
                    if(callback !== undefined){
                        callback();
                    }
                }

            }
            catch (e) {}

            isLoading.value = false;

        }

        return { data, load, isLoading }
    },
    getCampaignImages: () => {
        const load = (campaignImages, callback) => {
            if(campaignImages){
                campaignImages.forEach( async (campImg, index) =>{
                    try{
                        let response = await fetch('/api/campaign/image/'+campImg.url);
                        if(response.status === 200){
                            const blob = await response.blob();
                            //localUrls.value.push(URL.createObjectURL(blob));
                            callback(index, URL.createObjectURL(blob),true);
                        }

                    }
                    catch (e) {
                        callback(index, "",false);
                        console.log(e);
                    }

                });
            }
        };


        return { load }
    },
    editCampaign: () => {
        const data = ref(null);
        const isLoading = ref(false);

        const load =  async (formData, callback) => {
            try{
                isLoading.value = true;
                let response = await fetch('/api/campaign', {
                    method:'POST',
                    body: formData
                });
                if(response.status === 200){
                    data.value = (await response.json()).data;
                    if(callback !== undefined){
                        callback();
                    }
                }

            }
            catch (e) {}

            isLoading.value = false;

        }

        return { data, load, isLoading }
    },
}
