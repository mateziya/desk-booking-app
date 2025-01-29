<script setup>
import Dashboard from '../Components/Dashboard.vue';
import Pagination from '../Components/Pagination.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';

const props = defineProps({
  desks: Object,
  users: Object,
  selectedDate: String,
  reservations: Object
});

const isModalOpen = ref(false);
const selectedReservation = ref(null);

const openModal = (reservation) => {
  selectedReservation.value = reservation;
  isModalOpen.value = true;
};
const closeModal = () => {
  isModalOpen.value = false;
  selectedReservation.value = null;
};

const confirmDelete = () => {
  if (selectedReservation.value) {
    router.delete(route('delete.reservation', selectedReservation.value.id));
    closeModal();  
  }
};
</script>

<template>
  <Dashboard icon="circle-nodes" class="pb-2 max-sm:pb-2">
    <div class="pt-6">
      <div>
        <div class="flow-root overflow-hidden bg-gradient-to-t from-black/40 bg-white/5 rounded-3xl shadow ring-1 ring-white/10">
          <div class="mx-auto max-w-7xl px-6">
            <table class="w-full text-left">
              <thead>
                <tr>
                  <th scope="col" class="relative isolate py-3.5 pr-3 text-left text-xs sm:text-sm font-semibold text-slate-400">
                    ID
                    <div class="absolute inset-y-0 right-full -z-10 w-screen border-b border-b-gray-500/25" />
                    <div class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-b-gray-500/25" />
                  </th>
                  <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-slate-400 md:table-cell">User</th>
                  <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-slate-400 md:table-cell">User Email</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-xs sm:text-sm font-semibold text-slate-400">Desk</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-xs sm:text-sm font-semibold text-slate-400 sm:table-cell">Date</th>
                </tr>
              </thead>
              <tbody v-for="reservation in reservations.data" :key="reservation.id">
                <tr v-if="selectedDate === reservation.date">
                  <td class="relative py-4 pr-3 text-xs sm:text-sm font-medium text-gray-100">
                    {{ reservation.id }}
                  </td>
                  <td class="hidden px-3 py-4 text-sm text-gray-100 md:table-cell">{{ reservation.user.name }}</td>
                  <td class="hidden px-3 py-4 text-sm text-gray-100 md:table-cell">{{ reservation.user.email }}</td>
                  <td class="px-3 py-4 text-xs sm:text-sm">
                    <span class="hidde min-w-24 place-content-center rounded-md bg-green-50/5 px-2 py-1 font-medium text-center text-green-500 ring-1 ring-inset ring-green-600/20 sm:table-cell">
                      {{ reservation.desk.name }}
                    </span>
                  </td>
                  <td class="px-3 py-4 text-xs sm:text-sm text-gray-100">
                    {{ reservation.date }}
                  </td>
                  <td class="relative py-4  text-right text-xs sm:text-sm font-medium">
                    <button @click="openModal(reservation)" type="button" class="text-sm/6 font-semibold text-red-500 hover:text-red-400">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <Pagination :links="reservations.links"/>
    </div>
  </Dashboard>

  <TransitionRoot as="template" :show="isModalOpen">
    <Dialog class="relative z-10" @close="closeModal">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 backdrop-blur  bg-gray-500/20 transition-opacity" />
      </TransitionChild>
      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-3xl bg-white/10 backdrop-blur-sm ring-1 
              ring-white/20 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
              <div>
                <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-red-400/20">
                  <i class="fa-solid fa-bomb text-red-500 text-xl" aria-hidden="true"></i>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                  <DialogTitle as="h3" class="text-xl font-semibold text-white">Delete Reservation</DialogTitle>
                  <div class="mt-2">
                    <p class="text-gray-400 text-base/7 font-semibold">Are you sure you want to delete this reservation?</p>
                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                <button type="button" class="inline-flex w-full justify-center rounded-xl bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500 sm:col-start-2" @click="confirmDelete">Delete</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white/60 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 hover:bg-gray-300 sm:col-start-1 sm:mt-0" @click="closeModal" ref="cancelButtonRef">Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>