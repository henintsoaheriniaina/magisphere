<!-- component -->
<!-- This is an example component -->
<div>
    <select x-cloak id="select">
        <option value="1">Option 2</option>
        <option value="2">Option 3</option>
        <option value="3">Option 4</option>
        <option value="4">Option 5</option>
    </select>

    <div x-data="dropdown()" x-init="loadOptions()" class="mx-auto flex h-64 w-full flex-col items-center md:w-1/2">
        <form>
            <input name="values" type="hidden" x-bind:value="selectedValues()">
            <div class="relative inline-block w-64">
                <div class="relative flex flex-col items-center">
                    <div x-on:click="open" class="svelte-1l8159u w-full">
                        <div class="svelte-1l8159u my-2 flex rounded border border-gray-200 bg-white p-1">
                            <div class="flex flex-auto flex-wrap">
                                <template x-for="(option,index) in selected" :key="options[option].value">
                                    <div
                                        class="m-1 flex items-center justify-center rounded-full border border-teal-300 bg-teal-100 bg-white px-2 py-1 font-medium text-teal-700">
                                        <div class="x-model= max-w-full flex-initial text-xs font-normal leading-none"
                                            options[option]" x-text="options[option].text"></div>
                                        <div class="flex flex-auto flex-row-reverse">
                                            <div x-on:click="remove(index,option)">
                                                <svg class="h-6 w-6 fill-current" role="button" viewBox="0 0 20 20">
                                                    <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                         c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                         l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                         C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                </svg>

                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <div x-show="selected.length    == 0" class="flex-1">
                                    <input placeholder="Select a option"
                                        class="h-full w-full appearance-none bg-transparent p-1 px-2 text-gray-800 outline-none"
                                        x-bind:value="selectedValues()">
                                </div>
                            </div>
                            <div
                                class="svelte-1l8159u flex w-8 items-center border-l border-gray-200 py-1 pl-2 pr-1 text-gray-300">

                                <button type="button" x-show="isOpen() === true" x-on:click="open"
                                    class="h-6 w-6 cursor-pointer text-gray-600 outline-none focus:outline-none">
                                    <svg version="1.1" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
  c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
  L17.418,6.109z" />
                                    </svg>

                                </button>
                                <button type="button" x-show="isOpen() === false" @click="close"
                                    class="h-6 w-6 cursor-pointer text-gray-600 outline-none focus:outline-none">
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
  c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
  " />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4">
                        <div x-show.transition.origin.top="isOpen()"
                            class="top-100 lef-0 max-h-select svelte-5uyqqj absolute z-40 w-full overflow-y-auto rounded bg-white shadow"
                            x-on:click.away="close">
                            <div class="flex w-full flex-col">
                                <template x-for="(option,index) in options" :key="option">
                                    <div>
                                        <div class="w-full cursor-pointer rounded-t border-b border-gray-100 hover:bg-teal-100"
                                            @click="select(index,$event)">
                                            <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                                class="relative flex w-full items-center border-l-2 border-transparent p-2 pl-2">
                                                <div class="flex w-full items-center">
                                                    <div class="mx-2 leading-6" x-model="option" x-text="option.text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- on tailwind components page will no work  -->
                <button disabled
                    class="flex-shrink-0 rounded border-4 border-teal-500 bg-teal-500 px-2 py-1 text-sm text-white hover:border-teal-700 hover:bg-teal-700"
                    type="submit">Test</button>
        </form>
    </div>


    <script>
        function dropdown() {
            return {
                options: [],
                selected: [],
                show: false,
                open() {
                    this.show = true
                },
                close() {
                    this.show = false
                },
                isOpen() {
                    return this.show === true
                },
                select(index, event) {

                    if (!this.options[index].selected) {

                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);

                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
                },
                remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);


                },
                loadOptions() {
                    const options = document.getElementById('select').options;
                    for (let i = 0; i < options.length; i++) {
                        this.options.push({
                            value: options[i].value,
                            text: options[i].innerText,
                            selected: options[i].getAttribute('selected') != null ? options[i].getAttribute(
                                'selected') : false
                        });
                    }


                },
                selectedValues() {
                    return this.selected.map((option) => {
                        return this.options[option].value;
                    })
                }
            }
        }
    </script>
</div>
