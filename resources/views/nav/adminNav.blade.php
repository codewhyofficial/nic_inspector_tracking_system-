<nav class="flex justify-between bg-[#0a1333] py-3 sticky top-0 w-full z-10">
    <div class="flex items-center ml-9">
        <span class="text-xl text-white font-semibold">Admin</span>
    </div>
    <div class="flex items-center mr-10">
        <a href="{{ route('addInspector') }}" class="text-md text-gray-200 transition duration-300 ease-in-out mr-6 hover:bg-[#0d1c4e] p-2 rounded-md">Register New Inspector</a>
        <form action="{{ route('logout') }}" method="GETa" class="inline">
            @csrf
            <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-1 px-3 rounded">
                Logout
            </button>
        </form>
    </div>
</nav>