@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto mt-10 px-4">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">{{ __('Languages') }}</h1>
            <button id="addLanguageBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Add Language</button>
        </div>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">{{ __('Name') }}</th>
                <th class="py-2 px-4 border-b">{{ __('Code') }}</th>
                <th class="py-2 px-4 border-b">{{ __('RTL') }}</th>
                <th class="py-2 px-4 border-b">{{ __('Status') }}</th>
                <th class="py-2 px-4 border-b">{{ __('Default') }}</th>
                <th class="py-2 px-4 border-b">{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody id="languagesTable">
            <!-- Languages data will be injected here via jQuery -->
            </tbody>
        </table>
    </div>

    <!-- Add Language Modal -->
    <div id="addLanguageModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl mb-4">{{ __('Add language') }}</h2>
            <input type="text" id="newLanguageName" class="border p-2 w-full mb-4" placeholder="{{ __('Language Name') }}">
            <input type="text" id="newLanguageCode" class="border p-2 w-full mb-4" placeholder="{{ __('Language Code') }}">
            <label class="block mb-4">
                <span class="text-gray-700">{{ __('RTL') }}</span>
                <input type="checkbox" id="newLanguageRtl" class="ml-2" value="1">
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">{{ __('Status') }}</span>
                <input type="checkbox" id="newLanguageStatus" class="ml-2" value="1">
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">{{ __('Default') }}</span>
                <input type="checkbox" id="newLanguageDefault" class="ml-2" value="1">
            </label>
            <button id="saveLanguageBtn" class="bg-blue-500 text-white px-4 py-2 rounded">{{ __('Save') }}</button>
            <button id="cancelAddLanguageBtn" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">{{ __('Cancel') }}</button>
        </div>
    </div>

    <!-- Edit Language Modal -->
    <div id="editLanguageModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl mb-4">{{ __('Edit Language') }}</h2>
            <input type="hidden" id="editLanguageId">
            <input type="text" id="editLanguageName" class="border p-2 w-full mb-4" placeholder="Language Name">
            <input type="text" id="editLanguageCode" class="border p-2 w-full mb-4" placeholder="Language Code">
            <label class="block mb-4">
                <span class="text-gray-700">{{ __('RTL') }}</span>
                <input type="checkbox" id="editLanguageRtl" class="ml-2" value="1">
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">{{ __('Status') }}</span>
                <input type="checkbox" id="editLanguageStatus" class="ml-2" value="1">
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">{{ __('Default') }}</span>
                <input type="checkbox" id="editLanguageDefault" class="ml-2" value="1">
            </label>
            <button id="updateLanguageBtn" class="bg-blue-500 text-white px-4 py-2 rounded">{{ __('Update') }}</button>
            <button id="cancelEditLanguageBtn" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">{{ __('Cancel') }}</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const apiUrl = '{{ route('admin.language.getlist') }}';
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            function renderTable(languages) {
                const rows = languages.map(lang => `
                    <tr>
                        <td class="py-2 px-4 border-b">${lang.name}</td>
                        <td class="py-2 px-4 border-b">${lang.code}</td>
                        <td class="py-2 px-4 border-b">${lang.rtl ? 'Yes' : 'No'}</td>
                        <td class="py-2 px-4 border-b">${lang.status ? 'Active' : 'Inactive'}</td>
                        <td class="py-2 px-4 border-b">${lang.is_default ? 'Yes' : 'No'}</td>
                        <td class="py-2 px-4 border-b">
                            <button class="editLanguageBtn bg-yellow-500 text-white px-2 py-1 rounded" data-id="${lang.id}" data-name="${lang.name}" data-code="${lang.code}" data-rtl="${lang.rtl}" data-status="${lang.status}" data-default="${lang.is_default}">Edit</button>
                            <button class="deleteLanguageBtn bg-red-500 text-white px-2 py-1 rounded" data-id="${lang.id}">Delete</button>
                        </td>
                    </tr>
                `).join('');
                $('#languagesTable').html(rows);
            }

            function fetchLanguages() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $.get(apiUrl, function(data) {
                    renderTable(data);
                });
            }

            fetchLanguages();

            $('#addLanguageBtn').on('click', function() {
                $('#addLanguageModal').removeClass('hidden');
            });

            $('#cancelAddLanguageBtn').on('click', function() {
                $('#addLanguageModal').addClass('hidden');
            });

            $('#saveLanguageBtn').on('click', function() {
                const newLanguage = {
                    name: $('#newLanguageName').val(),
                    code: $('#newLanguageCode').val(),
                    rtl: $('#newLanguageRtl').is(':checked'),
                    status: $('#newLanguageStatus').is(':checked'),
                    is_default: $('#newLanguageDefault').is(':checked')
                };
                $.post(apiUrl, newLanguage, function() {
                    fetchLanguages();
                    $('#newLanguageName').val('');
                    $('#newLanguageCode').val('');
                    $('#newLanguageRtl').prop('checked', false);
                    $('#newLanguageStatus').prop('checked', false);
                    $('#newLanguageDefault').prop('checked', false);
                    $('#addLanguageModal').addClass('hidden');
                });
            });

            $(document).on('click', '.editLanguageBtn', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const code = $(this).data('code');
                const rtl = $(this).data('rtl');
                const status = $(this).data('status');
                const isDefault = $(this).data('default');

                $('#editLanguageId').val(id);
                $('#editLanguageName').val(name);
                $('#editLanguageCode').val(code);
                $('#editLanguageRtl').prop('checked', rtl);
                $('#editLanguageStatus').prop('checked', status);
                $('#editLanguageDefault').prop('checked', isDefault);
                $('#editLanguageModal').removeClass('hidden');
            });

            $('#cancelEditLanguageBtn').on('click', function() {
                $('#editLanguageModal').addClass('hidden');
            });

            $('#updateLanguageBtn').on('click', function() {
                const id = $('#editLanguageId').val();
                const updatedLanguage = {
                    name: $('#editLanguageName').val(),
                    code: $('#editLanguageCode').val(),
                    rtl: $('#editLanguageRtl').is(':checked'),
                    status: $('#editLanguageStatus').is(':checked'),
                    is_default: $('#editLanguageDefault').is(':checked')
                };
                $.ajax({
                    url: `${apiUrl}/${id}`,
                    type: 'PUT',
                    data: updatedLanguage,
                    success: function() {
                        fetchLanguages();
                        $('#editLanguageModal').addClass('hidden');
                    }
                });
            });

            $(document).on('click', '.deleteLanguageBtn', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `${apiUrl}/${id}`,
                    type: 'DELETE',
                    success: function() {
                        fetchLanguages();
                    }
                });
            });
        });
    </script>
@endsection
