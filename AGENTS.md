## 项目概述

[PHP Log-reader](https://github.com/krissss/php-log-reader) for webman，为 webman 提供日志阅读界面。

**核心功能**：
- **零配置启动**：安装后直接访问 `/log-reader` 即可
- **仅 debug 模式启用**：生产环境自动关闭
- **Web 界面**：通过浏览器查看日志文件
- **实时更新**：支持日志文件实时查看

## 开发命令

测试、静态分析等通用命令与根项目一致，详见根目录 [AGENTS.md](../../AGENTS.md)。

## 目录结构
- `src/`：
  - `LogReader.php`：日志读取核心类
  - `Controller/`：日志阅读控制器（支持 Webman 原生响应和 Symfony 响应两种实现）
  - `Helper/`：ConfigHelper
- `copy/`：配置文件模板
- `src/Install.php`：Webman 安装脚本

测试文件位于项目根目录的 `tests/Unit/LogReader/`。测试环境配置和 Helper 函数详见根目录 [AGENTS.md](../../AGENTS.md) 的测试相关章节。

## 工作流程

```
浏览器访问 /log-reader
    │
    ▼
LogReaderController
    │
    ▼
LogReader (php-log-reader)
    │
    ▼
读取日志文件 ──→ Web 界面展示 (分页 / 过滤 / 实时)
```

## 代码风格

与根项目保持一致，详见根目录 [AGENTS.md](../../AGENTS.md)。

## 注意事项

1. **仅开发环境**：只在 debug 模式下启用
2. **日志路径**：确保日志文件路径可读
3. **大文件**：大日志文件可能影响性能
4. **安全考虑**：生产环境应关闭此功能
