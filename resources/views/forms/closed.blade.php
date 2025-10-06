<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $form->title }} - Form Closed</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logos/hmif.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logos/hmif.png') }}">
    @vite(['resources/css/app.css', "resources/js/app.tsx"])
</head>
<body class="bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Form Header -->
            <div class="mb-6">
                @if($form->thumbnail)
                    <img src="{{ Storage::url($form->thumbnail) }}" alt="{{ $form->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                @endif
                
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $form->title }}</h1>
                
                @if($form->description)
                    <p class="text-gray-600 mb-4">{{ $form->description }}</p>
                @endif
            </div>

            <!-- Closed Message -->
            <div class="bg-red-50 border border-red-200 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            Form Tidak Tersedia
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>
                                @if(!$form->is_active)
                                    Form ini sedang tidak aktif.
                                @elseif($form->start_date && now()->isBefore($form->start_date))
                                    Form ini belum dibuka. Akan dibuka pada {{ $form->start_date->format('d M Y, H:i') }}.
                                @elseif($form->end_date && now()->isAfter($form->end_date))
                                    Form ini sudah ditutup pada {{ $form->end_date->format('d M Y, H:i') }}.
                                @elseif($form->submission_limit && $form->submission_count >= $form->submission_limit)
                                    Form ini sudah mencapai batas maksimal {{ $form->submission_limit }} submission.
                                @else
                                    Form ini sedang tidak menerima submission.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <button onclick="history.back()" 
                        class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    Kembali
                </button>
            </div>
        </div>
    </div>
</body>
</html>
