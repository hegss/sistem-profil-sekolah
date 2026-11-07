<x-app-layout>
    <section class="py-12 sm:py-16 bg-slate-50/60 dark:bg-slate-900/40 min-h-[85vh] flex items-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full space-y-6">

            <!-- Alert Success -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 flex items-center justify-between text-emerald-800 dark:text-emerald-200 text-xs sm:text-sm font-semibold shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="size-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" type="button" class="text-emerald-500 hover:text-emerald-700">✕</button>
                </div>
            @endif

            <!-- Main Container Card (#F4EBE8 Frame) -->
            <div class="bg-[#F4EBE8] dark:bg-slate-800 p-6 sm:p-10 rounded-[2.5rem] border border-rose-100/60 dark:border-slate-700/60 shadow-md space-y-8" 
                 x-data="{ activeTab: 'question' }">

                <!-- Tab Toggle Pills (Pertanyaan vs Komplain) -->
                <div class="flex justify-center">
                    <div class="bg-white/80 dark:bg-slate-900/80 p-1.5 rounded-full shadow-inner border border-slate-200/60 dark:border-slate-700 flex items-center gap-1">
                        <button type="button" 
                                @click="activeTab = 'question'"
                                :class="activeTab === 'question' ? 'bg-[#70282C] text-white shadow-md' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900'"
                                class="px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 focus:outline-none">
                            Pertanyaan Umum
                        </button>
                        <button type="button" 
                                @click="activeTab = 'complaint'"
                                :class="activeTab === 'complaint' ? 'bg-[#70282C] text-white shadow-md' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900'"
                                class="px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 focus:outline-none">
                            Form Komplain
                        </button>
                    </div>
                </div>

                <!-- TAB 1: PERTANYAAN (DROPDOWN ACCORDION JAWABAN) -->
                <div x-show="activeTab === 'question'" x-transition class="space-y-4">
                    <div class="text-center pb-2">
                        <h2 class="text-lg font-black text-slate-900 dark:text-white">Pertanyaan Sering Diajukan (FAQ)</h2>
                        <p class="text-xs text-slate-600 dark:text-slate-400">Klik pada pertanyaan untuk melihat jawaban resmi dari sekolah.</p>
                    </div>

                    <div class="space-y-3">
                        @foreach($faqs as $index => $faq)
                            <div x-data="{ open: false }" class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-700 overflow-hidden shadow-sm transition">
                                <button @click="open = !open" 
                                        type="button" 
                                        class="w-full text-left px-5 py-4 flex items-center justify-between gap-4 font-bold text-xs sm:text-sm text-slate-800 dark:text-white hover:text-[#70282C] transition">
                                    <span>{{ $faq['question'] }}</span>
                                    <svg class="size-4 shrink-0 transition-transform duration-300" :class="open ? 'rotate-180 text-[#70282C]' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-collapse x-cloak class="px-5 pb-4 text-xs text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-800 pt-3 bg-slate-50/50 dark:bg-slate-900/50">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- TAB 2: FORM KOMPLAIN -->
                <form action="{{ route('complaints.store') }}" method="POST" x-show="activeTab === 'complaint'" x-transition class="space-y-5" x-cloak>
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Kode Referral -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-800 dark:text-slate-200">
                                Kode Referral <span class="text-slate-400 font-normal">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   name="referral_code" 
                                   placeholder="Contoh: REF-12345" 
                                   class="w-full px-4 py-2.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#70282C] transition placeholder:text-slate-400">
                            @error('referral_code') <span class="text-[11px] text-rose-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Nama Pengirim -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-800 dark:text-slate-200">
                                Nama Pengirim <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   name="sender_name" 
                                   required
                                   placeholder="Masukkan nama lengkap pengirim" 
                                   class="w-full px-4 py-2.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#70282C] transition placeholder:text-slate-400">
                            @error('sender_name') <span class="text-[11px] text-rose-500 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nomor Telepon -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-800 dark:text-slate-200">
                                Nomor Telepon / WA <span class="text-rose-500">*</span>
                            </label>
                            <input type="tel" 
                                   name="sender_phone" 
                                   required
                                   placeholder="0812xxxxxxxx" 
                                   class="w-full px-4 py-2.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#70282C] transition placeholder:text-slate-400">
                            @error('sender_phone') <span class="text-[11px] text-rose-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Kategori Komplain -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-800 dark:text-slate-200">
                                Kategori Komplain <span class="text-rose-500">*</span>
                            </label>
                            <select name="category" 
                                    required
                                    class="w-full px-4 py-2.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#70282C] transition">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="infrastructure">Infrastruktur & Sarana Prasarana</option>
                                <option value="learning">Kegiatan Belajar Mengajar (KBM)</option>
                                <option value="others">Lainnya</option>
                            </select>
                            @error('category') <span class="text-[11px] text-rose-500 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Pesan Komplain -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-800 dark:text-slate-200">
                            Pesan / Detail Komplain <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="message" 
                                  rows="4" 
                                  required
                                  placeholder="Tuliskan komplain atau keluhan Anda secara detail..." 
                                  class="w-full px-4 py-2.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#70282C] transition placeholder:text-slate-400 leading-relaxed"></textarea>
                        @error('message') <span class="text-[11px] text-rose-500 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-3">
                        <button type="reset" 
                                class="px-6 py-2.5 rounded-full border border-slate-300 dark:border-slate-600 text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-7 py-2.5 rounded-full bg-[#70282C] hover:bg-[#591f23] text-white text-xs font-bold shadow-md hover:shadow-lg transition">
                            Kirim Komplain
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </section>
</x-app-layout>