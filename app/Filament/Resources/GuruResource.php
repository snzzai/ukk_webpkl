<?php


namespace App\Filament\Resources;


use App\Filament\Resources\GuruResource\Pages;
use App\Filament\Resources\GuruResource\RelationManagers;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;


class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;
    protected static ?string $navigationLabel = 'Guru';
    protected static ?string $pluralLabel = 'Guru';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('nip')
            ->label('NIP')
            ->required()
            ->maxLength(100)
            ->unique(ignoreRecord: true, column: 'nip', table: 'gurus')
            ->validationMessages([
                'unique' => 'NIP sudah dipakai.',]), // agar tidak eror saat nip dobel
           
            Forms\Components\Select::make('gender')
                ->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ])
                ->required()
                ->label('Jenis Kelamin'),

            Forms\Components\TextInput::make('alamat')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('kontak')
                ->required()
                ->maxLength(20),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
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

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->sortable(),

                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat'),

                Tables\Columns\TextColumn::make('kontak')
                    ->label('Kontak'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
