@csrf

<div class="form-group">
    <label class="form-label" for="name">Nombre del Proyecto</label>
    <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $proyect->name) }}">
</div>

<div class="form-group">
    <label class="form-label" for="description">Descripción</label>
    <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $proyect->description) }}">
</div>

<div class="row">
    <label for="personals" class="col-sm-3 col-form-label">Asignar Personal</label>
    <div class="col-sm-7">
        <div class="form-group">
            <div class="tab-content">
                <div class="tab-pane active">
                    <table class="table">
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="personals[]"
                                                value="{{ $user->id }}"
                                                @foreach ($proyect->users as $personal)
                                                    {{ $personal->id == $user->id ? 'checked' : '' }}
                                                @endforeach  
                                            >
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{ $user->fullName }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row ">
    <div class="text-center">
        <input class="btn btn-outline-success" type="submit" value="{{ __('Save') }}">        
    </div>
</div>

