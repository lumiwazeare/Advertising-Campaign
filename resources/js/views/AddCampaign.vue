<template>
    <section class="row justify-content-center">
        <div class="card m-lg-5 m-sm-1 col-lg-5 col-sm-12 col-md-12">
            <div class="card-title ps-3 pt-5 text-center">
                <h4>New Campaign</h4>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit">
                    <div class="form-floating">
                        <input type="text" v-model="name" class="form-control" required placeholder=""/>
                        <label class="form-label required"> Ad Name</label>
                    </div>

                    <div class="row mt-3">
                        <div class="input-group col">
                            <label class="input-group-text required">$</label>
                            <input type="number" v-model="dailyBudget" class="form-control" required placeholder="Daily Budget"/>
                        </div>

                        <div class="input-group col">
                            <label class="input-group-text required">$</label>
                            <input type="number" v-model="totalBudget" class="form-control" required placeholder="Total Budget"/>
                        </div>
                    </div>

                    <div class="row mt-3 gy-3">
                        <div class="input-group col">
                            <label class="input-group-text required">Start Date</label>
                            <input type="date" v-model="startDate" class="form-control" required placeholder=""/>
                        </div>

                        <div class="input-group col">
                            <label class="input-group-text required">End Date</label>
                            <input type="date" v-model="endDate" class="form-control" required placeholder=""/>
                        </div>
                    </div>

                    <div class="input-group mt-3">
<!--                        <label class="input-group-text required">Select Image Files</label>-->
                        <input type="file" ref="images" class="form-control" required placeholder="" multiple/>
                    </div>

                    <div class="mt-4 text-center" v-if="isLoading === false">
                        <button type="submit" class="btn btn-success"> Submit </button>
                    </div>

                    <div class="mt-4 text-center" v-else>
                       <label class="form-control">Loading....</label>
                    </div>

                </form>
            </div>
        </div>
    </section>

</template>

<script>

    import { ref } from 'vue';
    import { useRouter } from 'vue-router';
    import service from '../services/CampaignService'

    export default {
        name: "AddCampaign",
        setup(){
            const name = ref("");
            const startDate = ref("");
            const endDate = ref("");
            const dailyBudget = ref("");
            const totalBudget = ref("");
            const images = ref(null);
            const error = ref("");

            const router = useRouter();

            const { load, data, isLoading } = service.addCampaign();

            const submit = () => {
                //validate the input
                const tempStartDate = new Date(startDate.value);
                const tempEndDate = new Date(endDate.value);

                if(tempEndDate < tempStartDate) {
                    error.value = error.value + "campaign end date is lower than start date\n";
                }

                const tempDailyAmount = parseFloat(dailyBudget.value);
                const tempTotalAmount = parseFloat(totalBudget.value);

                if(tempDailyAmount > tempTotalAmount){
                    error.value = error.value + "campaign daily amount is more than total amount\n";
                }

                if(error.value.length > 0) {
                    alert(error.value);
                    error.value = "";
                    return;
                }

                error.value = "";
                const formData = new FormData();
                formData.append('name',name.value);
                formData.append('startDate',startDate.value);
                formData.append('endDate',endDate.value);
                formData.append('dailyBudget',dailyBudget.value);
                formData.append('totalBudget',totalBudget.value);

                if(images.value) {
                    for (let i = 0; i < images.value.files.length; i++) {
                        formData.append('images[]',images.value.files[i]);
                    }
                }

                load(formData,()=>
                {
                    alert("save successfully");
                    router.replace('/');
                });
            }


            return { name, startDate, endDate, dailyBudget, totalBudget, error, isLoading, submit, images }
        }
    }
</script>

<style scoped>
    .required:after{
        content: "*";
        color: red;
    }
</style>
