<script setup>
import { usePage, Link, router } from '@inertiajs/vue3'
import { ref, watch, computed } from 'vue';

const flash = ref({ success: '', error: '' });
const successSnackbar = ref(false);
const errorSnackbar = ref(false);

const updateSnackbars = (newValue) => {
    if (newValue) {
        flash.value = newValue;
        if (newValue.success) {
            successSnackbar.value = true;
        }
        if (newValue.error) {
            errorSnackbar.value = true;
        }
    }
};
watch(() => usePage().props.flash, updateSnackbars);
updateSnackbars(usePage().props.flash);
</script>
<template>
    <v-app id="inspire">
        <v-system-bar class="justify-space-between">
            <v-btn class="ms-2" :icon="leftDrawer ? 'mdi-close' : 'mdi-menu'" @click="toggleLeftDrawer"
                variant="text"></v-btn>
            <div>
                <span>{{ usePage().props.Auth.time }}</span>
                <v-icon v-if="usePage().props.Auth.logged" color="green" class="mx-2"
                    title="Your Are Logged In">mdi-check-circle</v-icon>
                <v-icon v-else class="mx-2" color="red" title="Your Are Logged Out">mdi-close-circle</v-icon>
            </div>
            <v-btn class="ms-2" :icon="rightDrawer ? 'mdi-close' : 'mdi-menu'" @click="toggleRightDrawer"
                variant="text"></v-btn>
        </v-system-bar>

        <v-navigation-drawer location="left" v-model="leftDrawer">
            <v-sheet class="pa-4" color="grey-lighten-4">
                <v-avatar class="mb-4" size="80">
                    <v-img alt="John" src="//placeholder.com/64x64?text=SKM"></v-img>
                </v-avatar>
                <div>{{ usePage().props.Auth.school_name }}</div>
            </v-sheet>

            <v-divider></v-divider>
            <v-list class="d-flex align-center flex-column" min-height="75%">
                <div v-for="(item, index) in usePage().props.NavUrl" :key="index" class="w-100">

                    <Link v-if="!item.has_children" :class="{ 'is_active': item.is_active }" :key="index" class="w-100"
                        as="button" :href="route(item.url)">
                    <v-list-item class="text-start" :prepend-icon="item.icon" link :title="item.text">
                    </v-list-item>
                    </Link>
                    <v-list-group v-else :value="item.text">
                        <template v-slot:activator="{ props }">
                            <v-list-item v-bind="props" :prepend-icon="item.icon"
                                :class="{ 'is_active': item.is_active }" :title="item.text"></v-list-item>
                        </template>
                        <Link v-for="(item2, i) in item.children" :key="i" :class="{ 'is_active': item2.is_active }"
                            class="w-100" @click.prevent="$event.stopPropagation()" as="button"
                            :href="route(item2.url)">
                        <v-list-item class="text-start" :title="item2.text" :value="item2.text"></v-list-item>
                        </Link>
                    </v-list-group>

                </div>

                <div class="pa-2 mt-auto">
                    <Link as="button" class="w-100" :href="route('logout')" method="post">
                    <v-btn prepend-icon="mdi-logout-variant" color="blue" class="text-start px-8" text="LogOut"
                        link></v-btn>
                    </LInk>
                </div>
            </v-list>
        </v-navigation-drawer>
        <v-navigation-drawer style="width:100px;" class="pt-4" location="right" temporary v-model="rightDrawer">
            <v-avatar v-for="n in 6" :key="n" :color="`grey-${n === 1 ? 'darken' : 'lighten'}-1`"
                :size="n === 1 ? 36 : 20" class="d-block text-center mx-auto mb-9"></v-avatar>
        </v-navigation-drawer>

        <v-main>
            <v-container class="py-8 px-6" fluid>
                <slot />
                <v-snackbar v-model="successSnackbar" color="success" timeout="3000">
                    {{ flash.success }}
                </v-snackbar>

                <!-- Error Snackbar -->
                <v-snackbar v-model="errorSnackbar" color="error" timeout="3000">
                    {{ flash.error }}
                </v-snackbar>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>

export default {
    data: () => ({
        cards: ['Today', 'Yesterday'],
        leftDrawer: true,
        rightDrawer: false,
        flash: {
            success: usePage().props.flash.success,
            error: usePage().props.flash.error,
        },
        errorSnackbar: usePage().props.flash.error ? true : false,
        successSnackbar: usePage().props.flash.success ? true : false,
    }),
    components: { Link },
    props: { NavUrl: Array },
    methods: {
        toggleRightDrawer() {
            this.rightDrawer = !this.rightDrawer;
            this.leftDrawer = false;
        },
        toggleLeftDrawer() {
            this.rightDrawer = false;
            this.leftDrawer = !this.leftDrawer;
        }
    }
}
</script>
<style scoped>
.is_active {
    background-color: #2196f3;
    color: white;
    opacity: 1;
}
</style>
