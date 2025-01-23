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
              <Link :href="route('calendar')" class="px-2 sm:px-3 lg:px-4 pt-2 md:pt-3 hover:text-indigo-600 text-lg md:text-xl lg:text-2xl font-semibold" :class="{'text-indigo-600 border-b-2 border-indigo-600' : $page.component === 'Calendar' || $page.component === 'AdminReservation' || $page.component === 'UserReservation'}">
                <i class="fa-solid fa-calendar-check"></i>
              </Link>
              <Link :href="route('admin.users')" v-if="user.role === 'admin'" class="px-2 sm:px-3 lg:px-4 pt-2 md:pt-3 hover:text-indigo-600 text-lg md:text-xl lg:text-2xl font-semibold" :class="{'text-indigo-600 border-b-2 border-indigo-600' : $page.component === 'UserList'}">
                <i class="fa-solid fa-user-group"></i>
              </Link>
              <Link :href="route('admin.desks')" v-if="user.role === 'admin'" class="px-2 sm:px-3 lg:px-4 pt-2 md:pt-3 hover:text-indigo-600 text-lg md:text-xl lg:text-2xl font-semibold" :class="{'text-indigo-600 border-b-2 border-indigo-600' : $page.component === 'DeskList'}">
                <i class="fa-solid fa-computer"></i>
              </Link>
            </div>
          </div>
          <slot /> 
        </div>
      </div>
  </Container>
</template>