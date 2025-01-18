<script setup>
import Container from './Container.vue';
import Title from './Title.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth.user);

defineProps({
  title: String,
  icon: String
});
</script>

<template>
  <Container class="mt-8 xl:max-w-7xl lg:max-w-6xl md:max-w-5xl sm:max-w-4xl max-sm:p-6 ">
      <div class="mb-2">
        <div class="divide-y divide-gray-500/25">
          <div class="flex justify-between">
            <div class="flex">
              <i :class="`fa-solid fa-${icon} text-white/85 pr-4 max-sm:pr-2 max-sm:text-2xl max-md:text-3xl max-lg:text-4xl text-5xl`"></i>
              <Title class="pb-3 text-white/85 max-sm:text-2xl max-sm:pb-2 max-md:text-3xl max-lg:text-4xl text-5xl">{{ title }}</Title>
            </div>
            <div class="flex text-slate-400">
              <Link :href="route('home')" v-if="user.role === 'user' && $page.component === 'UserCalendar'" class="px-4 pt-4 hover:text-indigo-600 text-base font-semibold max-xl:text-base max-md:text-sm max-sm:text-xs max-sm:px-1" :class="{'text-indigo-600 border-b-2 border-indigo-600' : $page.component === 'UserCalendar'}">
                Calendar
              </Link>
              <Link :href="route('calendar')" v-if="user.role === 'admin' && $page.component === 'UserCalendar'" class="px-4 pt-4 hover:text-indigo-600 text-base font-semibold max-xl:text-base max-md:text-sm max-sm:text-xs max-sm:px-1" :class="{'text-indigo-600 border-b-2 border-indigo-600' : $page.component === 'UserCalendar'}">
                Calendar
              </Link>
              <Link :href="route('admin.users')" v-if="user.role === 'admin' && $page.component === 'UserCalendar'" class="px-4 pt-4 hover:text-indigo-600 text-base font-semibold max-xl:text-base max-md:text-sm max-sm:text-xs max-sm:px-1" :class="{'text-indigo-600 border-b-2 border-indigo-600' : $page.component === 'UserList'}">
                Users
              </Link>
              <Link :href="route('admin.desks')" v-if="user.role === 'admin' && $page.component === 'UserCalendar'" class="px-4 pt-4 hover:text-indigo-600 text-base font-semibold max-xl:text-base max-md:text-sm max-sm:text-xs max-sm:px-1" :class="{'text-indigo-600 border-b-2 border-indigo-600' : $page.component === 'DeskList'}">
                Desks
              </Link>
            </div>
          </div>
          <slot /> 
        </div>
      </div>
  </Container>
</template>