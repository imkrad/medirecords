<template>
    <Head title="Users" />
    <PageHeader title="Patients" pageTitle="Lists" />
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Lists of Patients</h4>
            <div class="flex-shrink-0">
                <!-- <button class="btn btn-soft-info btn-sm" type="button">
                    <div class="btn-content"><i class="ri-file-list-3-line align-middle"></i> Generate Report </div>
                </button> -->
            </div>
        </div>
        <div class="card-body" style="height: calc(100vh - 270px); overflow: auto;">
            
        </div>
    </div>
</template>
<script>
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader }, 
    props: ['statuses'],
    data(){
        return {
            currentUrl: window.location.origin,
          
        }
    },
   
}
</script>