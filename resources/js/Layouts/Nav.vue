<script setup>
import { ref } from 'vue';
import { Dialog, DialogPanel } from '@headlessui/vue';

const mobileMenuOpen = ref(false);
</script>

<template>
  <header>
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-4 lg:px-8" aria-label="Global">
      <div class="flex items-center gap-x-1">
        <Link :href="route('home')" class="-m-1.5 p-1.5">
          <img class="h-10 w-auto" src="../Images/Icon.png" alt="App Logo" />
        </Link>
        <Link :href="route('home')" class="hidden lg:flex lg:gap-x-12 text-xl font-semibold text-white">
          Deskify
        </Link>
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400" @click="mobileMenuOpen = true">
          <i class="fa-solid fa-bars-staggered fa-lg" aria-hidden="true"></i>
        </button>
      </div>
      <div class="hidden lg:flex">
        <Link :href="route('login')" class="rounded-full bg-indigo-600 px-3.5 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-800">Log in</Link>
      </div>
    </nav>

    <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
      <div class="fixed inset-0 z-10">
      <DialogPanel class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-zinc-900 px-5 py-5 sm:max-w-sm sm:ring-1 sm:ring-white/10">
        <div class="flex items-center justify-between">
            <img class="h-8 w-auto" src="../Images/Icon.png" alt="App Logo" />
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-400" @click="mobileMenuOpen = false">
            <i class="fa-solid fa-xmark fa-lg" aria-hidden="true"></i>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/25">
            <div class="space-y-2 py-6">
              <Link :href="route('home')" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-zinc-800">Home</Link>
            </div>
            <div class="py-6">
              <Link :href="route('login')" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-zinc-800 ">Log in</Link>
            </div>
          </div>
        </div>
      </DialogPanel>
      </div>
    </Dialog>
  </header>

  <main>
      <slot />
  </main>
</template>