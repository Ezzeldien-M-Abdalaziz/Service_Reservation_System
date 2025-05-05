
@extends('layouts.frontend.app')
@section('body')
    <main class="flex-grow flex items-center justify-center py-12">
      <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-8">
          <h1 class="text-2xl font-bold text-gray-900">Login to Your Account</h1>
          <p class="text-gray-600 mt-2">Enter your credentials to access your account</p>
        </div>

        <form>
          <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
              type="email"
              id="email"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-500"
              placeholder="your@email.com"
              required
            />
          </div>

          <div class="mb-6">
            <div class="flex items-center justify-between mb-1">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <a href="#" class="text-sm text-brand-600 hover:text-brand-500">Forgot password?</a>
            </div>
            <input
              type="password"
              id="password"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-500"
              placeholder="••••••••"
              required
            />
          </div>

          <div class="flex items-center mb-6">
            <input type="checkbox" id="remember" class="h-4 w-4 text-brand-600 border-gray-300 rounded" />
            <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
          </div>

          <button
            type="submit"
            class="w-full bg-brand-600 text-white py-2 px-4 rounded-md hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
          >
            Login
          </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
          Don't have an account?
          <a href="/register.html" class="font-medium text-brand-600 hover:text-brand-500">Sign up</a>
        </p>
      </div>
    </main>

@endsection

