from flask import Flask, render_template, request, redirect
import mysql.connector

app = Flask(__name__)

# Kết nối cơ sở dữ liệu
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',  # Mật khẩu mặc định của XAMPP
    'database': 'loaihoa'
}

def get_db_connection():
    return mysql.connector.connect(**db_config)

# Trang hiển thị danh sách hoa (dành cho khách)
@app.route('/')
def index():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM flowers")
    flowers = cursor.fetchall()
    conn.close()
    return render_template('index.html', flowers=flowers)

# Trang quản trị
@app.route('/admin')
def admin():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM flowers")
    flowers = cursor.fetchall()
    conn.close()
    return render_template('admin.html', flowers=flowers)

# Thêm hoa mới
@app.route('/add', methods=['POST'])
def add():
    name = request.form['name']
    description = request.form['description']
    image_path = request.form['image_path']

    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("INSERT INTO flowers (name, description, image_path) VALUES (%s, %s, %s)",
                   (name, description, image_path))
    conn.commit()
    conn.close()
    return redirect('/admin')

# Xóa hoa
@app.route('/delete/<int:id>')
def delete(id):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("DELETE FROM flowers WHERE id = %s", (id,))
    conn.commit()
    conn.close()
    return redirect('/admin')

if __name__ == '__main__':
    app.run(debug=True)
