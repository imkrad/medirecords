<template>
    <Head title="Users" />
    <PageHeader title="Patients" pageTitle="Lists" />
   
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