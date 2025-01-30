<script setup>
import Dashboard from '../Components/Dashboard.vue';
import Pagination from '../Components/Pagination.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';

const props = defineProps({
  desks: Object,
});

const isModalOpen = ref(false);
const selectedDesk = ref(null);

const openModal = (desk) => {
  selectedDesk.value = desk;
  isModalOpen.value = true;
};
const closeModal = () => {
  isModalOpen.value = false;
  selectedDesk.value = null;
};

const confirmDelete = () => {
  if (selectedDesk.value) {
    router.delete(route('desks.destroy', selectedDesk.value.id));
    closeModal();  
  }
};
</script>

<template>
  <Dashboard icon="circle-nodes" class="pb-2 max-sm:pb-2">
    <div>
      <div class="flex justify-end pt-3 px-4">
            <Link :href="route('desks.create')" class="rounded-xl bg-indigo-600 px-3 py-2 text-center font-semibold text-sm text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-800 xl:text-sm max-md:text-xs">Add Desk</Link>
      </div>
      <div>
        <div class="mx-auto max-w-2xl lg:max-w-7xl">
          <div class="mt-3 grid grid-cols-1 gap-y-12 sm:gap-x-6 md:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <div v-for="desk in desks.data" :key="desk.id" class="bg-white/5 rounded-3xl ring-1 ring-white/10">
              <div class="relative">
                <div class="relative h-72 w-full overflow-hidden rounded-3xl">
                  <img v-if="desk.image_path" :src="`/storage/${desk.image_path}`" alt="" class="size-full object-cover">
                  <img v-else src="../Images/Default.png" alt="" class="size-full object-cover">
                </div>
                <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-t-3xl p-4">
                  <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-40" />
                  <p class="relative text-2xl font-semibold text-white">{{ desk.name }}</p>
                </div>
              </div>
              <div class="flex justify-center bg-black/40 rounded-b-3xl min-h-16 p-3">
                <button @click="openModal(desk)" type="button" class="text-lg font-semibold text-red-500 hover:text-red-400 p-2">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <Pagination :links="desks.links"/>
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
                  <DialogTitle as="h3" class="text-xl font-semibold text-white">Delete Desk</DialogTitle>
                  <div class="mt-2">
                    <p class="text-gray-400 text-base/7 font-semibold">Are you sure you want to delete this desk?</p>
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