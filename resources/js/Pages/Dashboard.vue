<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { ref, onMounted, reactive, computed } from 'vue';

const props = defineProps(['user_id']);
const teachers = ref([]);
const search = reactive({status: false});
const term = ref('');

const dataInit = async () => {
    loadData();
}

function openSearch() {
    search.status = true;   
}
function clearSearch() {
    term.value = '';
    loadData();  
}
function closeSearch() {
    setTimeout(() => {
        if(term.value) {
            return;
        }
        search.status = false;
        term.value = '';
    }, 1000);
        
}

function loadData() {
    axios.get('/api/teachers', {
        params: {
            school_id: 16,
            user_id: props.user_id,
            search_terms: term.value
        }
    })
    .then((res) => {
        teachers.value = res.data.teachers;
    })
    .catch((error) => {
        console.log(error);
    })
}

onMounted(dataInit)
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <!-- TODO: use once Role model is built -->
               <!-- {{ user.role.name }} Dashboard -->
               Coaches Dashboard
            </h2>
        </template>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-gray-200 w-12/12">
                        <div class="
                                min-w-full 
                                rounded-lg 
                                flex
                                justify-end
                                content-center"
                                @mouseover="openSearch"
                                @mouseleave.prevent="closeSearch"
                            >
                            <div 
                                class="m-6 font-semibold text-xl text-gray-800"   
                            >
                                <font-awesome-icon 
                                    icon="fa-solid fa-filter"
                                    v-if="!search.status" 
                                    class="text-4xl" 
                                ></font-awesome-icon>
                            </div>
                            <div 
                                class="m-3 p-3"
                                v-show="search.status"
                            >
                                <form 
                                    @submit.prevent="loadData"
                                    class="flex"
                                >
                                    <div class="custom-input-group">
                                        <span
                                            class="bg-gray-200 custom-input-group-icon"
                                            @click="clearSearch"
                                        >
                                            <svg 
                                                class="border-t border-b border-l border-black rounded-l-lg"
                                                width=50
                                                height=42
                                                viewBox="-5 -6 25 25"
                                                version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <line x1="1" y1="11" 
                                                    x2="11" y2="1" 
                                                    stroke="black" 
                                                    stroke-width="2"></line>
                                                <line x1="1" y1="1" 
                                                    x2="11" y2="11" 
                                                    stroke="black" 
                                                    stroke-width="2"></line>
                                            </svg>
                                        </span>
                                        <input 
                                            type="text" 
                                            name="term" 
                                            id="search" 
                                            v-model="term"
                                            class="rounded-lg custom-input-group-text"
                                        >
                                    </div>
                                    <button 
                                        type="button" 
                                        class="bg-blue-300 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg mx-2"
                                        @click="loadData(); closeSearch();"
                                    >
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200 sm:flex-none">
                        <div
                            v-for="teacher in teachers"
                            :key="teacher.id"
                        >
                            <Link 
                                :href="route('teacher-profile', {id: teacher.id})"
                            >
                                <div class="flex justify-center">
                                    <div class="flex flex-col md:flex-row md:max-w-xl min-w-full h-56 rounded-lg bg-white shadow-lg mb-8 sm:w-0">
                                        <img class="w-full md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" :src="teacher.avatar" :alt="teacher.fname + ' ' + teacher.lname +' avatar'" />
                                        <div class="p-6 flex flex-col justify-start">
                                        <h2 class="text-gray-900 text-3xl font-medium mb-2">{{ teacher.fname }} {{ teacher.lname }}</h2>
                                        <div class="text-lg  font-semibold">PD Notes:</div>
                                            <p class="text-gray-700 text-base mb-4">{{ teacher.pd_notes }}</p>
                                            <p class="text-gray-600 text-xs">Last Visit: {{ teacher.last_touch }}</p>
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
