@include('includes.head')

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                      
                    <div class="panel-body">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="{{ asset('public/uploads/logos/'.$organization->logo) }}" alt="LOGO" width="50%"/>

                        <br>
               
                        {{ Confide::makeLoginForm()->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
