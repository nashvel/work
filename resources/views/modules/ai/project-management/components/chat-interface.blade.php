<section class="mt-3 bg-white border border-gray-200 rounded-xl shadow-sm">
    <div id="chat" class="h-[520px] overflow-y-auto p-4 bg-gradient-to-b from-[#fbfdff] to-[#f7f9fc] rounded-t-xl space-y-3">
        <div id="emptyState" class="h-full grid place-items-center text-center text-slate-600">
            <div>
                <div class="text-2xl">🤖</div>
                <div class="font-semibold text-gray-900 mt-1">Start planning your project</div>
                <div class="max-w-xl mx-auto text-[15px]">Tell me the title, scope, due date, budget, and any tasks. If you don't have tasks, I'll suggest a complete list for you to import.</div>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-200 p-3 rounded-b-xl">
        <div class="flex items-end gap-2">
            <div class="relative flex-1">
                <div id="editor"
                     class="min-h-[42px] max-h-[120px] overflow-y-auto border border-gray-200 rounded-lg px-3 py-2 bg-white text-[15px] focus:outline-none focus:ring-2 focus:ring-blue-500"
                     contenteditable="true" role="textbox" aria-multiline="true"
                     data-placeholder="Type your message here. (Shift+Enter for new line)"></div>
                <div id="placeholder" class="pointer-events-none absolute left-3 top-2 text-slate-400 text-[15px]">
                    Create Full Project Plan
                </div>
            </div>
            <button id="send" class="px-3 py-2 text-sm rounded-lg bg-emerald-600 text-dark hover:bg-emerald-700">
                Send
            </button>
        </div>

        <div class="flex items-center justify-between mt-2">
            <div class="text-[12px] text-slate-600">Enter to send · Shift+Enter for new line</div>

            <div id="typing" class="hidden items-center gap-2 text-slate-600 font-semibold">
                <span class="inline-block w-2 h-2 rounded-full bg-gray-400 animate-bounce"></span>
                <span class="inline-block w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay:.15s"></span>
                <span class="inline-block w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay:.30s"></span>
                <span class="text-[13px]">AI is preparing a reply…</span>
            </div>
        </div>
    </div>
</section>