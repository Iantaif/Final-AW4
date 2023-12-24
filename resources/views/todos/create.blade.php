<x-app-layout>
<div class="text-center">
    <h1 class="text-4xl font-bold text-blue-500">Create Todo</h1>
</div>


  @if ($errors->any())
  <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
    
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form method="post" action="{{ route('todos.store') }}" class="max-w-sm mx-auto">
    @csrf

    <div class="mb-3">
      <label class="block mb-2 text-lg font-large  font-medium text-gray-900 dark:text-white">Title</label>
      <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="mb-3">
      <label class="block mb-2 text-lg font-large font-medium text-gray-900 dark:text-white">Description</label>
      <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="description" cols="5" rows="5"></textarea>
    </div>
  
    <div class="mb-3">
      <label class="block mb-2 text-lg font-large font-medium text-gray-900 dark:text-white">Category</label>
      <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>

        @endforeach
      </select>
    </div>

    <button type="submit" class="px-6 py-3 transition font-bold duration-150 ease-in-out bg-sky-500 hover:bg-sky-200 text-lg rounded-full">Create Todo</button>
  </form>
</x-app-layout>
