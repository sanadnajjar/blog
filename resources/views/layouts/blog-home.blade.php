<!DOCTYPE html>
<html lang="en">
<!--Header-->
@include('includes.home_header')

<!-- Navigation -->
@include('includes.home_nav')

<!-- Page Content -->

@include('includes.flash_messages')

@yield('content')

@include('includes.home_footer')
