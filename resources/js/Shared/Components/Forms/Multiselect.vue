<template>
    <Multiselect class="form-control w-lg" 
    v-model="selectedValues" 
    :options="options" label="name"
    :placeholder="placeholder" ref="multiselect"
    @update:modelValue="emitSelectedValues" 
   :style="'border-color: ' + (message ? '#f06548' : '#ced4da') + ' !important; '"/>
</template>
<script>
import Multiselect from "@vueform/multiselect";
export default {
    components: { Multiselect },
    props: ['options','modelValue','message','placeholder'],
    data() {
        return {
            selectedValues: this.modelValue
        };
    },
    methods: {
        emitSelectedValues(values) {
            this.selectedValues = values;
            this.$emit('update:modelValue', values); 
        },
        clear(){
            this.$refs.multiselect.clear();
        },
    }
}
</script>
<style>
.multiselect-wrapper {
  background-color: #f3f6f9;
  min-height: 34.5px !important;
}
</style>
