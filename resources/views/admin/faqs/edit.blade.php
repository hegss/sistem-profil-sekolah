<x-admin-layout>
    <!-- CDN Quill Rich Text Editor -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

    <div class="p-6 space-y-4 flex flex-col h-full overflow-y-auto custom-scrollbar">
        <div class="flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-xl font-bold text-red-900 dark:text-white">Edit FAQ</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">Perbarui template pertanyaan umum beserta jawaban resmi sekolah.</p>
            </div>

            <a href="{{ route('questions.index') }}"
                class="flex items-center gap-2 px-3.5 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-semibold rounded-lg transition">
                <x-back-arrow-icon class="size-4" />
                Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
            <form action="{{ route('questions.update', $question->id) }}" id="faqForm" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="question" class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                        Pertanyaan Umum <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="question" name="question_text" value="{{ old('question_text', $question->question_text) }}" required
                        placeholder="Contoh: Bagaimana prosedur pendaftaran siswa baru (PPDB)?"
                        class="w-full px-4 py-2.5 rounded-lg bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-[#70282C] focus:border-transparent">
                    @error('question_text')
                        <p class="text-[11px] text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                        Jawaban Resmi <span class="text-rose-500">*</span>
                    </label>
                    <input type="hidden" name="answer_text" id="answerInput" value="{{ old('answer_text', $question->answer_text) }}">

                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 overflow-hidden">
                        <div id="quillEditor" class="w-full text-xs bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-red-900 h-56">
                            {!! old('answer_text', $question->answer_text) !!}
                        </div>
                    </div>
                    @error('answer_text')
                        <p class="text-[11px] text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-2 border-t border-gray-100 dark:border-gray-700">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="size-4 text-red-900 rounded border-gray-300 focus:ring-amber-500">
                    <label for="is_active" class="text-xs font-semibold text-gray-700 dark:text-gray-200">Set sebagai aktif</label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit" class="px-5 py-2 bg-red-900 hover:bg-amber-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quill = new Quill('#quillEditor', {
                theme: 'snow',
                placeholder: 'Tuliskan jawaban lengkap di sini (bisa menggunakan bold, bullet list, atau link)...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link', 'clean']
                    ]
                }
            });

            document.getElementById('faqForm').addEventListener('submit', function () {
                const html = quill.root.innerHTML;
                document.getElementById('answerInput').value = (html === '<p><br></p>') ? '' : html;
            });
        });
    </script>
</x-admin-layout>
