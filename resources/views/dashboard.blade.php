<x-app-layout>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class=" p-8 rounded  text-center">
        <h1 class="text-3xl font-bold mb-6">This is Tai Todos</h1>
        <p class="text-gray-600">Let's started</p>

        <h1 class="text-center text-4xl font-bold my-8">
    <a class="text-black hover:text-blue-600" href="{{ url('/todos') }} " > Click here to navigate Todos</a>
</h1>
    </div>
    
</body>
  
</x-app-layout>
