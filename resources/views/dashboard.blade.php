<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="min-w-full text-left border-separate border-spacing-y-2">
                        <thead>
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
@foreach ($students as $student)
    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer"
        data-id="{{ $student->id }}"
        data-name="{{ $student->name }}"
        data-email="{{ $student->email }}"
        data-gender="{{ $student->gender }}"
        data-dob="{{ $student->date_of_birth }}"
        data-level="{{ $student->level }}"
        data-classgroup="{{ $student->class_group }}"
        onclick="openModal(this)">
    </tr>
@endforeach

@endforeach

                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $students->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Section -->
    <div id="studentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">Student Details</h2>

            <div class="space-y-2 text-gray-700 dark:text-gray-300">
                <p><strong>ID:</strong> <span id="modal-student-id"></span></p>
                <p><strong>Name:</strong> <span id="modal-student-name"></span></p>
                <p><strong>Email:</strong> <span id="modal-student-email"></span></p>
                <p><strong>Gender:</strong> <span id="modal-student-gender"></span></p>
                <p><strong>Date of Birth:</strong> <span id="modal-student-dob"></span></p>
                <p><strong>Level:</strong> <span id="modal-student-level"></span></p>
                <p><strong>Class Group:</strong> <span id="modal-student-classgroup"></span></p>
            </div>

            <button onclick="closeModal()" class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded-md">Close</button>
        </div>
    </div>

    <!-- JavaScript Section -->
    <script>
        function openModal(row) {
            const student = JSON.parse(row.dataset.student);

            document.getElementById('studentModal').classList.remove('hidden');
            document.getElementById('studentModal').classList.add('flex');

            document.getElementById('modal-student-id').innerText = student.id ?? 'N/A';
            document.getElementById('modal-student-name').innerText = student.name ?? 'N/A';
            document.getElementById('modal-student-email').innerText = student.email ?? 'N/A';
            document.getElementById('modal-student-gender').innerText = student.gender ?? 'N/A';
            document.getElementById('modal-student-dob').innerText = student.date_of_birth ?? 'N/A';
            document.getElementById('modal-student-level').innerText = student.level ?? 'N/A';
            document.getElementById('modal-student-classgroup').innerText = student.class_group ?? 'N/A';
        }


        function closeModal() {
            document.getElementById('studentModal').classList.add('hidden');
            document.getElementById('studentModal').classList.remove('flex');
        }
    </script>

</x-app-layout>
