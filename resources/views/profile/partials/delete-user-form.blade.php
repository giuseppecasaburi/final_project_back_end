<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium">
            Elimina Account
        </h2>

        <p class="mt-1 text-sm">
            Una volta eliminato l'account, tutte le tue risorse e i tuoi dati verranno eliminati definitivamente. Prima di eliminare il tuo account, scarica tutti i dati o le informazioni che desideri conservare.
        </p>
    </header>

    <!-- Modal trigger button -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-account">
        Elimina Account
    </button>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="delete-account" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="delete-account" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content delete-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-account">Elimina Account</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-lg font-medium">
                        Vuoi definitavemente eliminare il tuo account?
                    </h2>
                    <p class="mt-1 text-sm">
                        Sei sicuro di voler eliminare il tuo account e cancellare tutte le risorse e i dati ad esso collegati? Inserisci la tua password per confermare che desideri eliminare definitivamente il tuo account. 
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Annulla</button>

                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')


                        <div class="input-group">

                            <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}" />

                            @error('password')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $errors->userDeletion->get('password')}}</strong>
                            </span>
                            @enderror



                            <button type="submit" class="btn btn-danger mx-2">
                                Elimina definitivamente l'account
                            </button>
                            <!--  -->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</section>
