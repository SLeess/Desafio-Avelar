<option value="AC" title="Acre" {{ old($inputName, $value ?? '') === 'AC' ? 'selected' : '' }}>AC
</option>
<option value="AL" title="Alagoas" {{ old($inputName, $value ?? '') === 'AL' ? 'selected' : '' }}>AL
</option>
<option value="AP" title="Amapá" {{ old($inputName, $value ?? '') === 'AP' ? 'selected' : '' }}>AP
</option>
<option value="AM" title="Amazonas" {{ old($inputName, $value ?? '') === 'AM' ? 'selected' : '' }}>AM
</option>
<option value="BA" title="Bahia" {{ old($inputName, $value ?? '') === 'BA' ? 'selected' : '' }}>BA
</option>
<option value="CE" title="Ceará" {{ old($inputName, $value ?? '') === 'CE' ? 'selected' : '' }}>CE
</option>
<option value="DF" title="Distrito Federal" {{ old($inputName, $value ?? '') === 'DF' ? 'selected' : '' }}>DF
</option>
<option value="ES" title="Espírito Santo" {{ old($inputName, $value ?? '') === 'ES' ? 'selected' : '' }}>ES
</option>
<option value="GO" title="Goiás" {{ old($inputName, $value ?? '') === 'GO' ? 'selected' : '' }}>GO
</option>
<option value="MA" title="Maranhão" {{ old($inputName, $value ?? '') === 'MA' ? 'selected' : '' }}>MA
</option>
<option value="MT" title="Mato Grosso" {{ old($inputName, $value ?? '') === 'MT' ? 'selected' : '' }}>MT
</option>
<option value="MS" title="Mato Grosso do Sul" {{ old($inputName, $value ?? '') === 'MS' ? 'selected' : '' }}>MS
</option>
<option value="MG" title="Minas Gerais" {{ old($inputName, $value ?? '') === 'MG' ? 'selected' : '' }}>MG
</option>
<option value="PA" title="Pará" {{ old($inputName, $value ?? '') === 'PA' ? 'selected' : '' }}>PA
</option>
<option value="PB" title="Paraíba" {{ old($inputName, $value ?? '') === 'PB' ? 'selected' : '' }}>PB
</option>
<option value="PR" title="Paraná" {{ old($inputName, $value ?? '') === 'PR' ? 'selected' : '' }}>PR
</option>
<option value="PE" title="Pernambuco" {{ old($inputName, $value ?? '') === 'PE' ? 'selected' : '' }}>PE
</option>
<option value="PI" title="Piauí" {{ old($inputName, $value ?? '') === 'PI' ? 'selected' : '' }}>PI
</option>
<option value="RJ" title="Rio de Janeiro" {{ old($inputName, $value ?? '') === 'RJ' ? 'selected' : '' }}>RJ
</option>
<option value="RN" title="Rio Grande do Norte" {{ old($inputName, $value ?? '') === 'RN' ? 'selected' : '' }}>RN
</option>
<option value="RS" title="Rio Grande do Sul" {{ old($inputName, $value ?? '') === 'RS' ? 'selected' : '' }}>RS
</option>
<option value="RO" title="Rondônia" {{ old($inputName, $value ?? '') === 'RO' ? 'selected' : '' }}>RO
</option>
<option value="RR" title="Roraima" {{ old($inputName, $value ?? '') === 'RR' ? 'selected' : '' }}>RR
</option>
<option value="SC" title="Santa Catarina" {{ old($inputName, $value ?? '') === 'SC' ? 'selected' : '' }}>SC
</option>
<option value="SP" title="São Paulo" {{ old($inputName, $value ?? '') === 'SP' ? 'selected' : '' }}>SP
</option>
<option value="SE" title="Sergipe" {{ old($inputName, $value ?? '') === 'SE' ? 'selected' : '' }}>SE
</option>
<option value="TO" title="Tocantins" {{ old($inputName, $value ?? '') === 'TO' ? 'selected' : '' }}>TO
</option>



{{-- ex. validação para conter somente uma option quando já tem um value definido --}}

{{-- <option 
    @if(isset($value) && $value != "MG") 
        style="display: none" 
    @endif value="MG" title="Minas Gerais" {{ old($inputName, $value ?? '') === 'MG' ? 'selected' : '' }}>
    MG
</option> --}}
