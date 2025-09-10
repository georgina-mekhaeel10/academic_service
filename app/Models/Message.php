<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    

    // الحقول القابلة للتعبئة
    protected $fillable = ['conversation_id', 'student_id', 'support_id','reply_to_message_id', 'message', 'is_support'];

    /**
     * العلاقة مع المحادثة.
     */
      // علاقة مع الرسالة الأصلية



    //   public function down()
    // {
    //     Schema::table('messages', function (Blueprint $table) {
    //         $table->dropForeign(['reply_to_message_id']);
    //         $table->dropColumn('reply_to_message_id');
    //     });
    // }
      public function originalMessage()
      {
          return $this->belongsTo(Message::class, 'reply_to_message_id');
      }
      public function conversation()
      {
          return $this->belongsTo(Conversation::class, 'conversation_id');
      }
      
    /**
     * العلاقة مع الطالب.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * العلاقة مع الدعم.
     */
    public function support()
    {
        return $this->belongsTo(ASupports::class, 'support_id');
    }
}
