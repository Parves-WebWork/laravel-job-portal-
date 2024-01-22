@extends('user.dashboard')

@section('main')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid justify-content-center">
        <!-- Cards with title -->
        <br>
        @if(Session::has('message'))
        <div class="alert alert-warning">{{Session::get('message')}}</div>
    @endif
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title" style="    margin-left: 156px;">Weekly - $20</h5>
                            <br>
                            <hr style="margin-right: -62px;
                            border-top-width: 1px;
                            margin-left: 71px;">
                            <br>
                            <p class="card-text" style="    margin-left: 125px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <br>
                        <ul class="list-group list-group-flush" style="    margin-left: 125px;">
                            <li class="list-group-item">An item</li>
                            <hr>
                            <li class="list-group-item">A second item</li>
                            <hr>
                            <li class="list-group-item">A third item</li>
                            
                        </ul>
                        <hr style="    margin-right: -4px;
                        border-top-width: 1px;
                        margin-left: 121px;">
                        <br>
                        <div class="card-body text-center">
                            <a href="{{route('pay.weekly')}}" class="card-link">
                                <button
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="background-color: red;"
                              >
                                Pay
                              </button>
                            </a>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
         <!-- Cards with title -->
         <br>
         <div class="grid gap-6 mb-8 md:grid-cols-2">
             <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                 <div class="col-md-4">
                     <div class="card" style="width: 18rem;">
                         <div class="card-body">
                             <h5 class="card-title" style="    margin-left: 156px;">Monthly - $80</h5>
                             <br>
                             <hr style="margin-right: -62px;
                             border-top-width: 1px;
                             margin-left: 71px;">
                             <br>
                             <p class="card-text" style="    margin-left: 125px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                         </div>
                         <br>
                         <ul class="list-group list-group-flush" style="    margin-left: 125px;">
                             <li class="list-group-item">An item</li>
                             <hr>
                             <li class="list-group-item">A second item</li>
                             <hr>
                             <li class="list-group-item">A third item</li>
                             
                         </ul>
                         <hr style="    margin-right: -4px;
                         border-top-width: 1px;
                         margin-left: 121px;">
                         <br>
                         <div class="card-body text-center">
                             <a href="{{route('pay.monthly')}}" class="card-link">
                                 <button
                                 class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="background-color: red;"
                               >
                                 Pay
                               </button>
                             </a>
                         </div>
                      
                     </div>
                 </div>
             </div>
         </div>
          <!-- Cards with title -->
        <br>
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title" style="    margin-left: 156px;">Yearly - $200</h5>
                            <br>
                            <hr style="margin-right: -62px;
                            border-top-width: 1px;
                            margin-left: 71px;">
                            <br>
                            <p class="card-text" style="    margin-left: 125px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <br>
                        <ul class="list-group list-group-flush" style="    margin-left: 125px;">
                            <li class="list-group-item">An item</li>
                            <hr>
                            <li class="list-group-item">A second item</li>
                            <hr>
                            <li class="list-group-item">A third item</li>
                            
                        </ul>
                        <hr style="    margin-right: -4px;
                        border-top-width: 1px;
                        margin-left: 121px;">
                        <br>
                        <div class="card-body text-center">
                            <a href="{{route('pay.yearly')}}" class="card-link">
                                <button
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="background-color: red;"
                              >
                                Pay
                              </button>
                            </a>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
