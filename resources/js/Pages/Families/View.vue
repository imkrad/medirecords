<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 600px;" header-class="p-3 bg-primary-subtle" title="View Family" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <BRow v-if="selected">
            <BCol lg="12" class="mt-0">
                <div class="table-responsive mt-2">
                    <table class="table table-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr class="fs-11">
                                <td style="width: 7%;"></td>
                                <td>Name</td>
                                <td style="width: 30%;" class="text-center">Type</td>
                            </tr>
                        </thead>
                        <tbody v-if="selected.members.length > 0">
                            <tr v-for="(list,index) in selected.members" :key="index">
                                <td class="text-center"> {{ index+1 }} </td>
                                <td>{{ list.member.firstname }} {{ list.member.middlename }} {{ list.member.lastname }}</td>
                                <td class="text-center">{{ list.type.name }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="4" class="text-center text-muted fs-12">No family member found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </BCol>
        </BRow>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Close</b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data() {
        return {
            currentUrl: window.location.origin,
            selected: {
                members: []
            },
            showModal: false
        };
    },
    methods: { 
        show(data) {
            this.selected = data;
            this.showModal = true;
        },
        hide() {
            this.showModal = false;
        }
    }
};
</script>