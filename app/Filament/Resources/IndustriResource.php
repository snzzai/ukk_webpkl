<?php


namespace App\Filament\Resources;


use App\Filament\Resources\IndustriResource\Pages;
use App\Filament\Resources\IndustriResource\RelationManagers;
use App\Models\Industri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class IndustriResource extends Resource
{
    protected static ?string $model = Industri::class;
    protected static ?string $navigationLabel = 'Industri'; //untuk mengganti nama yang ada di side bar
    protected static ?string $pluralLabel = 'Industri'; //untuk mengganti nama yang ada di pagenya
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2'; //icon yang ada adi side bar


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('nama')
                ->label('Nama Industri')
                ->required()
                ->maxLength(255),


            Forms\Components\TextInput::make('bidang_usaha')
                ->label('Bidang Usaha')
                ->required()
                ->maxLength(255),


            Forms\Components\TextInput::make('alamat')
                ->label('Alamat')
                ->required()
                ->maxLength(255),


            Forms\Components\TextInput::make('kontak')
                ->label('Kontak')
                ->required()
                ->maxLength(255),


            Forms\Components\TextInput::make('email')
                ->label('Email')
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
            ->label('Nama Industri')
            ->searchable()
            ->sortable(),


        Tables\Columns\TextColumn::make('bidang_usaha')
            ->label('Bidang Usaha')
            ->searchable()
            ->sortable(),


        Tables\Columns\TextColumn::make('alamat')
            ->label('Alamat'),


        Tables\Columns\TextColumn::make('kontak')
            ->label('Kontak'),


        Tables\Columns\TextColumn::make('email')
            ->label('Email')
            ->searchable(),


        Tables\Columns\TextColumn::make('created_at')
            ->label('Dibuat')
            ->dateTime('d M Y')
            ->sortable(),
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
            'index' => Pages\ListIndustris::route('/'),
            'create' => Pages\CreateIndustri::route('/create'),
            'edit' => Pages\EditIndustri::route('/{record}/edit'),
        ];
    }
}
