@extends('layouts.app')

@section('title', 'Dokumentasi Website - Desa Wonokarang')

@section('content')
  
    <!-- Tim Pembuat Website -->
    <section class="py-10 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-primary mb-4">Tim Pembuat Website</h2>
                    <p class="text-xl text-gray-600">Developer khusus yang menangani pembuatan website</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Developer 1 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/team/muafi.JPG') }}" 
                                 alt="Ahmad Muafi" class="w-full h-58 sm:h-66 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <h3 class="font-bold text-lg mb-1">Ahmad Muafi T</h3>
                                <p class="text-sm mb-2">Lead Developer</p>
                                <div class="flex gap-2 justify-right">
                                   <a href="#" class="w-6 h-6 bg-pink-600 rounded-full flex items-center justify-center">
                                        <i data-lucide="instagram" class="w-3 h-3"></i>
                                    </a>
                                    <a href="#" class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i data-lucide="linkedin" class="w-3 h-3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Developer 2 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/team/sipak.JPG') }}" 
                                 alt="M Syifaul Anam" class="w-full h-58 sm:h-66 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <h3 class="font-bold text-lg mb-1">M Syifaul Anam</h3>
                                <p class="text-sm mb-2">UI/UX Designer</p>
                                <div class="flex gap-2 justify-right">
                                    <a href="#" class="w-6 h-6 bg-pink-600 rounded-full flex items-center justify-center">
                                        <i data-lucide="instagram" class="w-3 h-3"></i>
                                    </a>
                                    <a href="#" class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i data-lucide="linkedin" class="w-3 h-3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Developer 3 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/team/nadip.JPG') }}" 
                                 alt="Nadhif Fathur Rahman" class="w-full h-58 sm:h-66 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <h3 class="font-bold text-lg mb-1">Nadhif Fathur Rahman</h3>
                                <p class="text-sm mb-2">Frontend Developer</p>
                                <div class="flex gap-2 justify-right">
                                    <a href="#" class="w-6 h-6 bg-pink-600 rounded-full flex items-center justify-center">
                                        <i data-lucide="instagram" class="w-3 h-3"></i>
                                    </a>
                                    <a href="#" class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i data-lucide="linkedin" class="w-3 h-3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Developer 4 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/team/fito.JPG') }}" 
                                 alt="Rina Wati" class="w-full h-58 sm:h-66 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <h3 class="font-bold text-lg mb-1">Fitto Ardiansyah</h3>
                                <p class="text-sm mb-2">Content Manager</p>
                                <div class="flex gap-2 justify-right">
                                    <a href="#" class="w-6 h-6 bg-pink-600 rounded-full flex items-center justify-center">
                                        <i data-lucide="instagram" class="w-3 h-3"></i>
                                    </a>
                                    <a href="#" class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i data-lucide="linkedin" class="w-3 h-3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Dokumentasi -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-primary mb-4">Galeri Dokumentasi</h2>
                    <p class="text-xl text-gray-600">Foto-foto selama proses pembuatan website</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <!-- Foto 1 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/brainstorming.jpg') }}" 
                                 alt="Brainstorming session" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Brainstorming Session</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 2 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/coding-session.jpg') }}" 
                                 alt="Coding session" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Coding Marathon</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 3 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/design-review.jpg') }}" 
                                 alt="Design review" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Design Review</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 4 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/testing-phase.jpg') }}" 
                                 alt="Testing phase" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Testing Phase</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 5 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/team-discussion.jpg') }}" 
                                 alt="Team discussion" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Team Discussion</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 6 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/coffee-break.jpg') }}" 
                                 alt="Coffee break" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Coffee Break</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 7 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/midnight-coding.jpg') }}" 
                                 alt="Late night coding" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Midnight Coding</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 8 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/sprint-planning.jpg') }}" 
                                 alt="Sprint planning" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Sprint Planning</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 9 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/debug-session.jpg') }}" 
                                 alt="Debug session" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Debug Session</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 10 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/whiteboard-session.jpg') }}" 
                                 alt="Whiteboard session" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Whiteboard Session</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 11 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/code-review.jpg') }}" 
                                 alt="Code review" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Code Review</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 12 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/team-lunch.jpg') }}" 
                                 alt="Team lunch" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Team Lunch</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 13 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/team-celebration.jpg') }}" 
                                 alt="Team celebration" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Team Celebration</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 14 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/final-presentation.jpg') }}" 
                                 alt="Final presentation" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Final Presentation</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 15 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/launch-day.jpg') }}" 
                                 alt="Launch day" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Launch Day!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto 16 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                        <div class="relative group flex-shrink-0">
                            <img src="{{ asset('img/docs/meeting-room.jpg') }}" 
                                 alt="Meeting room" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Meeting Room</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
