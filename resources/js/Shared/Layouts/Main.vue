<script>
import { layoutComputed } from "@/Shared/State/helpers";
import Vertical from "./Vertical.vue";
import Horizontal from "./Horizontal.vue";
import TwoColumns from "./Twocolumn.vue";
import { Inertia } from "@inertiajs/inertia";
export default {
    components: {
        Vertical,
        Horizontal,
        TwoColumns
    },
    data() {
        return {};
    },
    computed: {
        ...layoutComputed,
        message() {
            return (this.$page.props.flash.message) ?  true : false;
        }
    },
    mounted() {
        document.addEventListener("scroll", function () {
                var pageTopbar = document.getElementById("page-topbar");
                if (pageTopbar) {
                    document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50 ? pageTopbar
                        .classList.add(
                            "topbar-shadow") : pageTopbar.classList.remove("topbar-shadow");
                }
            });
            if (document.getElementById("topnav-hamburger-icon"))
                document.getElementById("topnav-hamburger-icon").addEventListener("click", this.toggleHamburgerMenu);
        },
        methods: {
            check(){
                this.$page.props.flash = {};
                this.message = false;
            },
            refreshData() {
            Inertia.reload({ only: ['notification'] }); // Specify the prop you want to refresh
        },
    }
};
</script>

<template>
    <div>
        <Vertical v-if="layoutType === 'vertical' || layoutType === 'semibox'" :layout="layoutType">
            <slot />
        </Vertical>

        <Horizontal v-if="layoutType === 'horizontal'" :layout="layoutType">
            <slot />
        </Horizontal>

        <TwoColumns v-if="layoutType === 'twocolumn'" :layout="layoutType">
            <slot />
        </TwoColumns>
    </div>
    <b-modal v-model="message" hide-footer class="v-modal-custom" modal-class="zoomIn" body-class="p-0" centered hide-header-close style="z-index: 5000;">
        <div class="modal-body text-center p-5">
            <div class="pt-4">
                <h4>{{$page.props.flash.message }}</h4>
                <p class="text-muted"> {{$page.props.flash.info }}</p>
                <button @click="check()" class="btn btn-success" data-bs-target="#secondmodal" data-bs-toggle="modal" data-bs-dismiss="modal">
                    Continue
                </button>
            </div>
        </div>
    </b-modal>
</template>
