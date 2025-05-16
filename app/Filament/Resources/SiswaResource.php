<?php


namespace App\Filament\Resources;


use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;
    protected static ?string $navigationLabel = 'Siswa';
    protected static ?string $pluralLabel = 'Siswa';
    protected static ?string $navigationIcon = 'heroicon-o-user';


    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255),


            Forms\Components\TextInput::make('nis')
                ->required()
                ->unique(ignoreRecord: true, column: 'nis', table: 'siswas')
                ->maxLength(255)
                ->validationMessages([
                'unique' => 'NIS sudah dipakai.',
            ]),


            Forms\Components\Select::make('gender')
                ->required()
                ->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ]),


            Forms\Components\TextInput::make('alamat')
                ->required()
                ->maxLength(255),


            Forms\Components\TextInput::make('kontak')
                ->required()
                ->tel()
                ->maxLength(255),


            Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->unique(ignoreRecord: true)
                ->maxLength(255)
 
               
        ]);
}




public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('nama')
                ->label('Nama')
                ->searchable()
                ->sortable(),


            Tables\Columns\TextColumn::make('nis')
                ->label('NIS')
                ->searchable()
                ->sortable(),


            Tables\Columns\TextColumn::make('gender')
                ->label('Jenis Kelamin')
                ->sortable()
                ->formatStateUsing(fn ($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan'),


            Tables\Columns\TextColumn::make('alamat')
                ->label('Alamat')
                ->limit(30),


            Tables\Columns\TextColumn::make('kontak')
                ->label('Kontak'),


            Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->searchable(),


                Tables\Columns\TextColumn::make('status_pkl')
                ->label('Status PKL')
                ->badge()
                ->formatStateUsing(fn ($record) => $record->status_pkl ? 'true' : 'false')
                ->colors([
                    'success' => fn ($state) => $state === 'true' ? 'green' : null,
                    'danger' => fn ($state) => $state === 'false' ? 'red' : null,
                ]),
           
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}


    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
