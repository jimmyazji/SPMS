<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
        <form method="POST" action="{{route('projects.destroy', $project->id)}}">
            @csrf
            @method('DELETE')
            <x-modal>
                <x-slot name="trigger">
                    <x-button type="button" class="bg-red-700 hover:bg-red-500" @click="showModal = true"
                        value="Click Here">Delete Project</x-button>
                </x-slot>
                <x-slot name="title">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Delete Project
                    </h3>
                </x-slot>
                <x-slot name="content">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete the {{ $project->title }}? All of its
                        data will be permanently removed. This action cannot be undone.
                    </p>
                </x-slot>
            </x-modal>
        </form>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('projects.update',$project->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-row-2 gap-6 mt-4 border-b border-gray-300 pb-8">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="title" :value="__('Project Title')" />
                                    <x-input error="title" class="block mt-1 w-full" type="text" name="title"
                                        placeholder="Project Title" :value="$project->title" autofocus />
                                </div>
                                <div>
                                    <x-label for="repo" :value="__('Project\'s Repository')" />
                                    <select name="repo"
                                        class="block mt-1 text-sm text-gray-800 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                                        id="repo">
                                        <option selected value="">Create New</option>
                                        @foreach ($repos as $repo)
                                        <option class="capitalize" @selected($repo['url']==$project->url) value="{{
                                            $repo['url'] }}">{{ $repo['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-label for="type" :value="__('Project\'s Type')" />
                                    <select name="type"
                                        class="block mt-1 text-sm text-gray-800 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full capitalize"
                                        id="type">
                                        <option disabled>Select Type</option>
                                        @foreach ($types as $type)
                                        <option class="capitalize" @selected($type->value == $project->type->value)
                                            value="{{
                                            $type->value }}">{{ $type->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-label for="spec" :value="__('Project\'s Specialization')" />
                                    <select name="spec"
                                        class="block mt-1 text-sm text-gray-800 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full capitalize"
                                        id="spec">
                                        <option disabled>Select Type</option>
                                        @foreach ($specs as $spec)
                                        <option class="capitalize" @selected($spec->value == $project->spec->value)
                                            value="{{
                                            $spec->value }}">{{ $spec->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @can('project-approve')
                                <div>
                                    <x-label for="state" :value="__('Project\'s State')" />
                                    <select name="state"
                                        class="block mt-1 text-sm text-gray-800 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full capitalize"
                                        id="state">
                                        <option selected disabled>Select Type</option>
                                        @foreach ($states as $state)
                                        <option class="capitalize" @selected($state->value == $project->state->value)
                                            value="{{
                                            $state->value }}">{{ $state->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endcan
                            </div>
                        </div>
                        <section x-data="handler()">
                            <div class="py-8 border-b border-gray-300">
                                <x-label class="mb-2" for="aims" :value="__('Project\'s Aims')" />
                                <template x-for="(aim, index) in aims" :key="index" x-init="initAims()">
                                    <div class="flex justify-center items-center space-x-2">
                                        <span x-text="index+1"></span>
                                        <x-input class="block mt-1 w-full" type="text" x-model="aims[index].name"
                                            name="aims[]" placeholder="Project's Aim" error="aims.*" required />
                                        <x-input type="checkbox" x-model="aims[index].complete" name="aims_complete[]"
                                            x-bind:value="aims[index].name" placeholder="Project's task"
                                            error="aims.*" />
                                        <span title="add aim"
                                            class="w-5 flex justify-center items-center cursor-pointer"
                                            @click="addAimField()"><i class="fa fa-plus"></i></span>
                                        <span title="delete aim"
                                            class="w-5 flex justify-center items-center cursor-pointer"
                                            @click="removeAimField(index)"><i
                                                class="fa fa-plus transform rotate-45"></i></span>
                                    </div>
                                </template>
                            </div>
                            <div class="py-8 border-b border-gray-300">
                                <x-label class="mb-2" for="objective" :value="__('Project\'s Objectives')" />
                                <template x-for="(objective, index) in objectives" :key="index" x-init="initObj()">
                                    <div class="flex justify-center items-center space-x-2">
                                        <span x-text="index+1"></span>
                                        <x-input class="block mt-1 w-full" type="text" x-model="objectives[index].name"
                                            name="objectives[]" id="objectives" placeholder="Project's Objective"
                                            error="objectives.*" required />
                                        <x-input type="checkbox" x-model="objectives[index].complete"
                                            name="objectives_complete[]" x-bind:value="objectives[index].name"
                                            placeholder="Project's task" error="objectives.*" />
                                        <span title="add objective"
                                            class="w-5 flex justify-center items-center cursor-pointer"
                                            @click="addObjField()"><i class="fa fa-plus"></i></span>
                                        <span title="delete objective"
                                            class="w-5 flex justify-center items-center cursor-pointer"
                                            @click="removeObjField(index)"><i
                                                class="fa fa-plus transform rotate-45"></i></span>
                                    </div>
                                </template>
                            </div>
                            <div class="py-8 border-b border-gray-300">
                                <x-label class="mb-2" for="task" :value="__('Project\'s Tasks')" />
                                <template x-for="(task, index) in tasks" :key="index" x-init="initTasks()">
                                    <div class="flex justify-center items-center space-x-2">
                                        <span x-text="index+1"></span>
                                        <x-input class="block mt-1 w-full" type="text" x-model="tasks[index].name"
                                            name="tasks[]" placeholder="Project's task" error="tasks.*" />
                                        <x-input type="checkbox" x-model="tasks[index].complete" name="tasks_complete[]"
                                            x-bind:value="tasks[index].name" placeholder="Project's task"
                                            error="tasks.*" />
                                        <span title="add task"
                                            class="w-5 flex justify-center items-center cursor-pointer"
                                            @click="addTaskField()"><i class="fa fa-plus"></i></span>
                                        <span title="delete task"
                                            class="w-5 flex justify-center items-center cursor-pointer"
                                            @click="removeTaskField(index)"><i
                                                class="fa fa-plus transform rotate-45"></i></span>
                                    </div>
                                </template>
                            </div>
                        </section>
                        <div class="pt-8 flex @can('project-supervise'){ justify-between }@else{ justify-end }@endcan">
                            @can('project-supervise')
                            <label class="inline-flex items-center">
                                <input name="supervise" id="supervise" type="checkbox" value="{{ Auth::user()->id }}" {{
                                    $project->supervisor_id == Auth::id() ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300
                                focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600">
                                    I will supervise this project
                                </span>
                            </label>
                            @endcan
                            <x-button>
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function handler() {
    return {
        aims: [],
        objectives: [],
        tasks: [],
        addAimField() {
            this.aims.push('');
        },
        removeAimField(index) {
            if(this.aims.length == 1){
                this.addAimField();
            }
            this.aims.splice(index, 1);
        },
        initAims(){
            var oldAims = {!! $project->aims !!} ?? [];
            this.aims = this.aims.concat(oldAims);
            if (oldAims.length == 0){
                this.addAimField();
            }
        },
        addObjField() {
            this.objectives.push('');
        },
        removeObjField(index) {
            if(this.objectives.length == 1){
                this.addObjField();
            }
            this.objectives.splice(index, 1);
        },
        initObj(){
            var oldObj = {!! $project->objectives !!} ?? [];
            this.objectives = this.objectives.concat(oldObj);
            if (oldObj.length == 0){
                this.addObjField();
            }
        },
        addTaskField() {
            this.tasks.push('');
        },
        removeTaskField(index) {
            if(this.tasks.length == 1){
                this.addTaskField();
            }
            this.tasks.splice(index, 1);
        },
        initTasks(){
            var oldTasks = {!! $project->tasks !!} ?? [];
            this.tasks = this.tasks.concat(oldTasks);
            if (oldTasks.length == 0){
                this.addTaskField();
            }
        }
      }
 }
</script>