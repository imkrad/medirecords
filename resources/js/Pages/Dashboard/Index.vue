<template>
    <Head title="Dashboard" />
    <PageHeader title="Dashboard" pageTitle="Page" />
    <BRow class="g-3" style="height: calc(100vh - 200px); overflow: auto;">
        <Top ref="top"/>
        <BCol xl="8">
            <Bar ref="bar"/>
        </BCol>
        <BCol xl="4">
            <Info ref="info"/>
        </BCol>
    </BRow>
</template>
<script>
import _ from 'lodash';
import Top from './Top.vue';
import Bar from './Bar.vue';
import Info from './Info.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader, Bar, Info, Top }, 
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            index: null,
            filter: {
                keyword: null,
                status: null,
                sortby: 'Created At',
                sort: 'desc'
            },
            index: null,
        }
    },
    watch: {
        "filter.keyword"(newVal){
            this.checkSearchStr(newVal)
        }
    },
    created(){
       
    },
    methods: {

    }
}
</script>