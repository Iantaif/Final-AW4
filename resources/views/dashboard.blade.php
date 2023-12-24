<x-app-layout>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md text-center">
        <h1 class="text-3xl font-bold mb-6">Đây là Todos Của Tài</h1>
        <p class="text-gray-600">Bắt đầu làm việc trên những công việc của bạn ngay bây giờ!</p>

        <h1 class="text-center text-4xl font-bold my-8">
    <a class="text-black hover:text-blue-600" href="{{ url('/todos') }} " >Nhấn Vào Đây để xem Todos</a>
</h1>
    </div>
</body>
  
</x-app-layout>
