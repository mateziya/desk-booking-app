<script setup>
import Dashboard from '../Components/Dashboard.vue';
import Title from '../Components/Title.vue';
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth.user);

const currentDate = new Date();
const currentMonth = ref(currentDate.getMonth());
const currentYear = ref(currentDate.getFullYear());

const monthNames = [
  'January', 'February', 'March', 'April', 'May', 'June',
  'July', 'August', 'September', 'October', 'November', 'December'
];

const daysInMonth = computed(() => {
  const days = [];
  const firstDay = new Date(currentYear.value, currentMonth.value, 1).getDay();
  const totalDays = new Date(currentYear.value, currentMonth.value + 1, 0).getDate();

  for (let i = 1 - (firstDay === 0 ? 6 : firstDay - 1); i <= totalDays; i++) {
    days.push(new Date(currentYear.value, currentMonth.value, i));
  }
  return days;
});

const isToday = (date) => {
  const today = new Date();
  return date.getDate() === today.getDate() &&
    date.getMonth() === today.getMonth() &&
    date.getFullYear() === today.getFullYear();
};

const isCurrentMonth = (date) => {
  return date.getMonth() === currentMonth.value;
};

const isSaturday = (date) => {
  return date.getDay() === 6;
};

const isSunday = (date) => {
  return date.getDay() === 0;
};

const workDays = (date) => {
  const day = date.getDay();
  if (day >= 1 && day <= 5 && isCurrentMonth(date)) {
    return true;
  }
}

const nextMonth = () => {
  if (currentMonth.value === 11) {
    currentMonth.value = 0;
    currentYear.value++;
  } else {
    currentMonth.value++;
  }
};

const prevMonth = () => {
  if (currentMonth.value === 0) {
    currentMonth.value = 11;
    currentYear.value--;
  } else {
    currentMonth.value--;
  }
};
const selectedDate = (day) => {
  return currentYear.value  + '-' + ((currentMonth.value) + 1) + '-' + day.getDate();
};
</script>

<template>
  <Dashboard icon="circle-nodes">
    <div class="pt-3">
      <div class="flex justify-between items-center pb-3 px-4">
          <button @click="prevMonth" class="min-w-8 sm:min-w-10 rounded-lg md:rounded-xl bg-indigo-600 px-4 md:px-5 py-1 md:py-2 text-center font-semibold text-xs text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-800">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <Title class="text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl">{{ monthNames[currentMonth] }} {{ currentYear }}</Title>
          <button @click="nextMonth" class="in-w-8 sm:min-w-10 rounded-lg md:rounded-xl bg-indigo-600 px-4 md:px-5 py-1 md:py-2 text-center font-semibold text-xs text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-800">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>
      <div class="flow-root overflow-hidden bg-gradient-to-t from-black/40 bg-white/5 rounded-3xl shadow ring-1 ring-white/10">
        <div class="divide-y divide-gray-500/25 mt-2 my-3 mx-3">
          <div class="grid grid-cols-7">
            <p class="py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-slate-400">
              M
            </p>
            <p class="py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-slate-400">
              T
            </p>
            <p class="py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-slate-400">
              W
            </p>
            <p class="py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-slate-400">
              T
            </p>
            <p class="py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-slate-400">
              F
            </p>
            <p class="py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-white/40">
              S
            </p>
            <p class="py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-indigo-600">
              S
            </p>
          </div>
          <div class="grid grid-cols-7 pt-2">
            <div v-if="user.role === 'user'" v-for="(day, index) in daysInMonth" :key="index" class="flex justify-center">
              <Link v-if="isToday(day)"
              class="w-full m-1 py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg font-semibold text-gray-100 ring-3 ring-indigo-800 bg-indigo-600/20 rounded-md md:rounded-lg hover:ring-3 hover:ring-indigo-700/50 hover:bg-indigo-500/10"
              :href="route('reserve', selectedDate(day) )">
                {{ day.getDate() }}
              </Link>
              <Link v-else-if="workDays(day)"
              class="w-full m-1 py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg font-semibold text-gray-100 bg-slate-500/5 rounded-md md:rounded-lg hover:ring-3 hover:ring-indigo-800/50 hover:bg-indigo-600/10"
              :href="route('reserve', selectedDate(day) )">
                {{ day.getDate() }}
              </Link>
              <p v-else
              :class="{
                  'ring-3 ring-indigo-800 bg-indigo-600/20': isToday(day),
                  'text-white/15 bg-slate-600/5': !isCurrentMonth(day),
                  'text-white/40 bg-slate-500/10': isSaturday(day),
                  'text-indigo-600 bg-indigo-700/20': isSunday(day)
                }" 
              class="w-full m-1 py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg font-semibold text-gray-100 rounded-md md:rounded-lg">
                {{ day.getDate() }}
              </p>
            </div>

            <div v-if="user.role === 'admin'" v-for="(day, index) in daysInMonth" :key="index" class="flex justify-center">
              <Link v-if="isToday(day)"
              class="w-full m-1 py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg font-semibold text-gray-100 ring-3 ring-indigo-800 bg-indigo-600/20 rounded-md md:rounded-lg hover:ring-3 hover:ring-indigo-700/50 hover:bg-indigo-500/10"
              :href="route('reservations', selectedDate(day) )">
                {{ day.getDate() }}
              </Link>
              <Link v-else-if="workDays(day)"
              class="w-full m-1 py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg font-semibold text-gray-100 bg-slate-500/5 rounded-md md:rounded-lg hover:ring-3 hover:ring-indigo-800/50 hover:bg-indigo-600/10"
              :href="route('reservations', selectedDate(day) )">
                {{ day.getDate() }}
              </Link>
              <p v-else
              :class="{
                  'ring-3 ring-indigo-800 bg-indigo-600/20': isToday(day),
                  'text-white/15 bg-slate-600/5': !isCurrentMonth(day),
                  'text-white/40 bg-slate-500/10': isSaturday(day),
                  'text-indigo-600 bg-indigo-700/20': isSunday(day)
                }" 
              class="w-full m-1 py-2 sm:py-4 md:py-6 lg:py-8 text-center text-sm sm:text-base md:text-lg font-semibold text-gray-100 rounded-md md:rounded-lg">
                {{ day.getDate() }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Dashboard>
</template>