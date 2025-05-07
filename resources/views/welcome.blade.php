
@extends('layouts.frontend.app')

@section('body')
<main class="flex-grow">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-brand-500 to-blue-600 text-white py-20">
      <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
          <h1 class="text-4xl md:text-5xl font-bold mb-6">
            Book Professional Services with Ease
          </h1>
          <p class="text-xl mb-8">
            Find and reserve the services you need in minutes. No hassle, no waiting.
          </p>
          <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{route('login.form')}}">
              <button class="w-full sm:w-auto bg-white text-brand-600 `ver:bg-gray-100 px-8 py-3 rounded-md font-medium">
                Login
              </button>
            </a>
            <a href="{{route('register.form')}}">
              <button class="w-full sm:w-auto bg-brand-700 text-white hover:bg-brand-800 px-8 py-3 rounded-md font-medium">
                Sign Up
              </button>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="text-center p-6">
            <div class="bg-brand-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
              <span class="text-brand-500 text-2xl font-bold">1</span>
            </div>
            <h3 class="text-xl font-semibold mb-2">Create an Account</h3>
            <p class="text-gray-600">
              Sign up for an account to get started with our services.
            </p>
          </div>

          <div class="text-center p-6">
            <div class="bg-brand-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
              <span class="text-brand-500 text-2xl font-bold">2</span>
            </div>
            <h3 class="text-xl font-semibold mb-2">Browse Services</h3>
            <p class="text-gray-600">
              Explore our range of professional services tailored to your needs.
            </p>
          </div>

          <div class="text-center p-6">
            <div class="bg-brand-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
              <span class="text-brand-500 text-2xl font-bold">3</span>
            </div>
            <h3 class="text-xl font-semibold mb-2">Book and Enjoy</h3>
            <p class="text-gray-600">
              Select a service, choose a time, and confirm your reservation.
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
