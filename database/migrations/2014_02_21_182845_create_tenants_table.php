<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plan_id');
            $table->uuid('uuid');
            $table->string('cnpj')->unique();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('url')->unique();
            $table->string('logo')->nullable();
            

            //status tenant (se quiser 'N' ele perde acesso ao sistema)
            $table->enum('active', ['Y', 'N'])->default('Y');

            //subscription

            $table->date('subscription')->nullable(); //data em que se inscrevel
            $table->date('expires_at')->nullable(); //data que expira o acesso
            $table->string('subscription_id', 255)->nullable(); // Identificador de Gateway de pagamento
            $table->boolean('subscripton_active')->default(false); //Assinatura Ativa(por padrão vem falso)
            $table->boolean('subscription_suspended')->default(false); // Assinatura cancelada por padrão vem falso
            
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
