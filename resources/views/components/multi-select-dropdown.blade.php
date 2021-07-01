<script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
<select multiple id="select" class="hidden">
    {{ $options }}
</select>
<div x-data="dropdown()" x-init="loadOptions()" class="mt-1 relative flex flex-col items-center mx-auto"
    {{ $attributes }}>
    <form>
        <input name="roles" type="hidden" class="" x-bind:value="selectedValues()">
        <div class="inline-block relative w-full">
            <div class="flex flex-col items-center relative">
                <div x-on:click="open" class="w-full  svelte-1l8159u">
                    <div
                        class="p-1 flex rounded-md shadow-sm border border-gray-300 text-sm text-gray-800  svelte-1l8159u">
                        <div class="flex flex-auto flex-wrap">
                            <template x-for="(option,index) in selected" :key="options[option].value">
                                <div
                                    class="mx-0.5 flex justify-center items-center font-medium px-2 rounded-2xl text-sm text-gray-700 bg-gray-100 border border-gray-300 ">
                                    <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                        options[option]" x-text="options[option].text"></div>
                                    <div class="flex flex-auto items-start flex-row-reverse">
                                        <div x-on:click="remove(index,option)">
                                            <svg class="fill-current mt-0.5 h-4 w-4 " role="button" viewBox="0 0 20 20">
                                                <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                    c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                    l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                    C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="selected.length    == 0" class="flex-1 text-sm text-gray-800">
                                <input placeholder="Select Roles"
                                    class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                    x-bind:value="selectedValues()">
                            </div>
                        </div>
                        <div class="text-sm text-gray-300 w-8 py-0.5 pl-2 pr-1 flex items-center svelte-1l8159u">

                            <button type="button"
                                class="cursor-pointer w-6 h-6 text-sm text-gray-600 outline-none focus:outline-none">
                                <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                            c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                            L17.418,6.109z" />
                                </svg>

                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div x-show.transition.origin.top="isOpen()"
                        class="absolute shadow top-100 bg-white z-40 max-h-24 w-full rounded-lg overflow-y-auto scrollbar-thin svelte-5uyqqj"
                        x-on:click.away="close">
                        <div class="flex flex-col w-full">
                            <template x-for="(option,index) in options" :key="option">
                                <div class="text-sm text-gray-800">
                                    <div class="cursor-pointer w-full border-gray-200 rounded-t border-b hover:bg-gray-100"
                                        @click="select(index,$event)">
                                        <div x-bind:class="option.selected ? 'border-gray-800' : ''"
                                            class="flex w-full items-center p-1 pl-2 border-transparent border-l-2 relative">
                                            <div class="w-full items-center flex">
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
    </form>
</div>
<script>
    function dropdown() {
              return {
                  options: [],
                  selected: [],
                  show: false,
                  open() { this.show = true },
                  close() { this.show = false },
                  isOpen() { return this.show === true },
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
                              selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                          });
                      }
                  },
                  selectedValues(){
                      return this.selected.map((option)=>{
                          return this.options[option].value;
                      })
                  }
              }
          }
</script>